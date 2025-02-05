# Architecture-MVC
This project aims to design a clean and modular MVC architecture in PHP, with PostgreSQL as database. The objective is to have a strict separation of responsibilities, a back office for administration and a front office for public display. The architecture should be extensible, secure and well-structured, applying good development practices.

### **🛠 Update User (MVC Pattern)**
This implementation adds **Update (Edit User) functionality** to your **MVC User Management System**.

---

## **1️⃣ Update Method in the User Model (`app/models/User.php`)**
```php
public function updateUser($id, $name, $email) {
    $query = "UPDATE " . $this->table . " SET name = :name, email = :email WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    return $stmt->execute();
}
```

---

## **2️⃣ Update Method in the Controller (`app/controllers/UserController.php`)**
```php
public function edit($id) {
    $user = $this->userModel->getUserById($id);
    require_once __DIR__ . '/../views/edit_user.php';
}

public function update($id, $name, $email) {
    if ($this->userModel->updateUser($id, $name, $email)) {
        header("Location: index.php");
    } else {
        echo "Error updating user.";
    }
}
```

---

## **3️⃣ Edit User View (`app/views/edit_user.php`)**
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
        <h1>Edit User</h1>
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            <button type="submit">Update User</button>
        </form>
    </div>

</body>
</html>
```

---

## **4️⃣ Update Entry Point (`public/update.php`)**
```php
<?php
require_once __DIR__ . '/../app/controllers/UserController.php';

$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($_POST['id'], $_POST['name'], $_POST['email']);
}
?>
```

---

## **5️⃣ Modify User List View (`app/views/users.php`)**
Modify the **edit button** to link to `edit.php`:
```html
<a href="edit.php?id=<?= $user['id'] ?>" class="edit-btn">Edit</a>
```

---

## **6️⃣ Create `edit.php` to Load the Edit Form**
```php
<?php
require_once __DIR__ . '/../app/controllers/UserController.php';

$controller = new UserController();
$controller->edit($_GET['id']);
?>
```

