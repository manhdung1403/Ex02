<?php
session_start();

// Định nghĩa class Customer
class Customer {
    public $id;
    public $username;
    public $password;
    public $fullname;
    public $address;
    public $phone;
    public $gender;
    public $birthday;

    public function __construct($id, $username, $password, $fullname, $address, $phone, $gender, $birthday) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->fullname = $fullname;
        $this->address = $address;
        $this->phone = $phone;
        $this->gender = $gender;
        $this->birthday = $birthday;
    }
}

// Khởi tạo mảng khách hàng trong session nếu chưa có
if (!isset($_SESSION['customers'])) {
    $_SESSION['customers'] = [];
}

// Xử lý khi submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $fullname = $_POST['fullname'] ?? '';
    $address = $_POST['address'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $birthday = $_POST['birthday'] ?? '';

    // Tạo đối tượng Customer và thêm vào session
    $customer = new Customer($id, $username, $password, $fullname, $address, $phone, $gender, $birthday);
    $_SESSION['customers'][] = $customer;
}

$customers = $_SESSION['customers'];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý khách hàng</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; margin: 0; }
        .container { max-width: 700px; margin: 40px auto; background: #fff; padding: 30px 40px 40px 40px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        header, footer { background: #007bff; color: #fff; text-align: center; padding: 16px 0; }
        h2 { color: #007bff; }
        table, th, td { border: 1px solid #dee2e6; border-collapse: collapse; padding: 5px; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 20px; }
        label { display: block; margin: 8px 0 4px 0; }
        input, select { padding: 5px; margin-bottom: 8px; width: 100%; max-width: 350px; }
        input[type="submit"] { width: auto; background: #007bff; color: #fff; border: none; border-radius: 4px; padding: 8px 16px; cursor: pointer; }
        input[type="submit"]:hover { background: #0056b3; }
        table { width: 100%; margin-top: 16px; }
    </style>
</head>
<body>
    <header>
        <h1>Hệ thống quản lý khách hàng</h1>
    </header>
    <div class="container">
        <h2>Thêm khách hàng mới</h2>
        <form method="post">
            <label>ID:</label> <input type="text" name="id" required>
            <label>Tên đăng nhập:</label> <input type="text" name="username" required>
            <label>Mật khẩu:</label> <input type="password" name="password" required>
            <label>Họ tên:</label> <input type="text" name="fullname" required>
            <label>Địa chỉ:</label> <input type="text" name="address" required>
            <label>Số điện thoại:</label> <input type="text" name="phone" required>
            <label>Giới tính:</label>
            <select name="gender" required>
                <option value="">Chọn</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
            <label>Ngày sinh:</label> <input type="date" name="birthday" required>
            <input type="submit" value="Thêm khách hàng">
        </form>

        <h2>Danh sách khách hàng</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Tên đăng nhập</th>
                <th>Mật khẩu</th>
                <th>Họ tên</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
            </tr>
            <?php foreach ($customers as $c): ?>
            <tr>
                <td><?php echo htmlspecialchars($c->id); ?></td>
                <td><?php echo htmlspecialchars($c->username); ?></td>
                <td><?php echo htmlspecialchars($c->password); ?></td>
                <td><?php echo htmlspecialchars($c->fullname); ?></td>
                <td><?php echo htmlspecialchars($c->address); ?></td>
                <td><?php echo htmlspecialchars($c->phone); ?></td>
                <td><?php echo htmlspecialchars($c->gender); ?></td>
                <td><?php echo htmlspecialchars($c->birthday); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Quản lý khách hàng</p>
    </footer>
</body>
</html>
