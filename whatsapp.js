import { makeWASocket, DisconnectReason, fetchLatestBaileysVersion, useMultiFileAuthState } from '@whiskeysockets/baileys';
import express from 'express';
import bodyParser from 'body-parser';
import axios from 'axios';
import fs from 'fs';
import dotenv from 'dotenv';

dotenv.config(); // Load environment variables from .env file

const app = express();
app.use(bodyParser.json());

let sock;

async function connectToWhatsApp() {
    try {
        const { version, isLatest } = await fetchLatestBaileysVersion();
        console.log(`Using WhatsApp version v${version.join('.')}, latest: ${isLatest}`);

        const { state, saveCreds } = await useMultiFileAuthState('auth_info');

        sock = makeWASocket({
            version,
            auth: state,
            printQRInTerminal: true,
        });

        sock.ev.on('creds.update', saveCreds);

        sock.ev.on('connection.update', async (update) => {
            const { connection, lastDisconnect, qr } = update;

            if (qr) {
                try {
                    console.log('Sending QR code to Laravel API...');
                    const response = await axios.post(`${process.env.APP_URL}/api/whatsapp-qr`, { qr });
                    console.log('QR code successfully sent', response.status, response.data);
                } catch (error) {
                    handleAxiosError(error, 'Error sending QR code');
                }
            }

            if (connection === 'close') {
                const shouldReconnect = (lastDisconnect.error?.output?.statusCode !== DisconnectReason.loggedOut);
                console.log('Connection closed due to', lastDisconnect.error, ', reconnecting:', shouldReconnect);

                if (lastDisconnect.error?.output?.statusCode === 401 && lastDisconnect.error?.data?.content?.[0]?.attrs?.type === 'device_removed') {
                    console.log('Device conflict detected, deleting auth_info and reconnecting...');
                    fs.rmSync('auth_info', { recursive: true, force: true }); // Delete the auth_info directory
                    setTimeout(connectToWhatsApp, 5000); // Reconnect after 5 seconds
                    return;
                }

                // Update connection status to Laravel
                try {
                    const response = await axios.post(`${process.env.APP_URL}/api/whatsapp-status`, { status: 'disconnected' });
                    console.log('Disconnected status successfully sent', response.status, response.data);
                } catch (error) {
                    handleAxiosError(error, 'Error sending disconnected status');
                }

                if (shouldReconnect) {
                    setTimeout(connectToWhatsApp, 5000); // Reconnect after 5 seconds
                }
            } else if (connection === 'open') {
                console.log('Connection opened');
                try {
                    const response = await axios.post(`${process.env.APP_URL}/api/whatsapp-status`, { status: 'connected' });
                    console.log('Connection status successfully sent', response.status, response.data);
                } catch (error) {
                    handleAxiosError(error, 'Error sending connection status');
                }
            }
        });
    } catch (err) {
        console.error('Error connecting to WhatsApp:', err);
    }
}

function handleAxiosError(error, message) {
    if (error.response) {
        console.error(`${message}:`, error.response.status, error.response.data);
    } else if (error.request) {
        console.error('No response from server:', error.request);
    } else {
        console.error('Error in request setup:', error.message);
    }
}

app.post('/send-message', async (req, res) => {
    const { recipient, message } = req.body;
    const formattedRecipient = `${recipient}@s.whatsapp.net`; // Ensure correct JID format

    console.log('Received send-message request:', req.body); // Add this line

    try {
        const messageWithSignature = `${message}\n\n— Bot`; // Add the signature to the message
        await sock.sendMessage(formattedRecipient, { text: messageWithSignature });
        res.json({ status: 'success', message: 'Message sent' });
    } catch (error) {
        console.error('Error sending message:', error);
        res.status(500).json({ status: 'error', message: 'Failed to send message' });
    }
});

app.listen(3000, () => {
    console.log('Server is running on port 3000');
});

connectToWhatsApp();
