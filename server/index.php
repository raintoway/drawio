<?php
// 设置响应头，允许跨域请求
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 确保请求是 POST 请求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 检查是否有文件上传
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

        // 生成唯一的文件名
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $uuid = uniqid();
        $newFileName = $uuid . '.' . $extension;

        // 保存上传的文件
        $uploadPath = 'uploads/' . $newFileName;
        move_uploaded_file($file['tmp_name'], $uploadPath);
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        echo json_encode(array('url' => "http://localhost:8000/uploads/$newFileName"));
    } else {
        echo "No file uploaded\n";
    }
} else {
    echo "Invalid request method\n";
}
?>
