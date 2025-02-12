const express = require("express");
const http = require("http");
const WebSocket = require("ws");
const cors = require("cors");
require("dotenv").config();

const app = express();
const server = http.createServer(app);
const wss = new WebSocket.Server({ noServer: true });

app.use(cors());
app.use(express.json());

const SECRET_TOKEN = process.env.WEBSOCKET_SECRET;

// Handle WebSocket upgrade request
server.on("upgrade", (request, socket, head) => {
  const url = new URL(request.url, `http://${request.headers.host}`);
  const token = url.searchParams.get("token");

  if (!token || token !== SECRET_TOKEN) {
    console.log("WebSocket connection rejected: Invalid token");
    socket.write("HTTP/1.1 401 Unauthorized\r\n\r\n");
    socket.destroy();
    return;
  }

  console.log("WebSocket connection approved");
  wss.handleUpgrade(request, socket, head, (connection) => {
    wss.emit("connection", connection, request);
  });
});

// Handle WebSocket connections
wss.on("connection", (ws) => {
  console.log("New WebSocket connection");
});

app.post("/send-order", (req, res) => {
  const { order, token } = req.body;

  // Verify token
  if (token !== SECRET_TOKEN) {
    return res.status(403).json({ error: "Unauthorized" });
  }

  console.log("Received from Laravel:", order);

  wss.clients.forEach((client) => {
    if (client.readyState === WebSocket.OPEN) {
      client.send(JSON.stringify(order));
    }
  });

  res.status(200).json({ status: "Order sent to all clients" });
});

const PORT = 6001;
server.listen(PORT, () =>
  console.log(`WebSocket Server running on port ${PORT}`)
);
