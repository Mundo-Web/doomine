<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Message Detail PDF</title>
  <style>
    body {
      font-family: 'Nunito', sans-serif;
    }

    .container {
      width: 100%;
      padding: 20px;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .details {
      margin-bottom: 20px;
    }

    .details h2 {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .details p {
      margin-bottom: 5px;
    }

    .message-content {
      padding: 15px;
      background-color: #f8f8f8;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1 class="text-2xl font-bold">Detalle del Mensaje</h1>
    </div>

    <div class="details">
      <h2 class="text-xl font-semibold">Información del Remitente</h2>
      <p><strong>Nombre:</strong> {{ $message->full_name }}</p>
      <p><strong>Email:</strong> {{ $message->email }}</p>
      <p><strong>Fecha:</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="message-content">
      <h2 class="text-xl font-semibold">Mensaje:</h2>
      <p>{{ $message->message }}</p>
    </div>
  </div>
</body>

</html>
