const { spawn } = require('child_process');
const port = process.env.PORT || 8080;

// هذا الكود يفتح عملية فرعية لتشغيل خادم Vite على منفذ Hostinger
const app = spawn('npm', ['run', 'preview', '--', '--port', port, '--host', '0.0.0.0'], {
    stdio: 'inherit',
    shell: true 
});

app.on('error', (err) => {
    console.error('Failed to start the application:', err);
});
