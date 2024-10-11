<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .access-denied-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .access-denied-container h1 {
            font-size: 2.5rem;
            color: #e74c3c;
            margin-bottom: 20px;
        }

        .access-denied-container p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .access-denied-container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .access-denied-container a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="access-denied-container">
        <h1>Bạn không có quyền truy cập</h1>
        <p>Xin lỗi, bạn không có quyền để truy cập trang này.</p>
        {{-- <a href="/">Trở về trang chủ</a> --}}
    </div>
</body>
</html>