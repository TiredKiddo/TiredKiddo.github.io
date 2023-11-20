<!DOCTYPE html>
<html>
<head>
    <title>Agregar Producto Nuevo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
        }

        input[type="file"] {
            width: 100%;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
             <h2>Agregar Producto</h2>
        <form action="procesai.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nom">Nombre del producto:</label>
                <input type="text"   name="nombre" required>
            </div>
            <div class="form-group">
                <label for="desc">Descripcion:</label>
                <textarea  name="descripcion" required></textarea>
            </div>
            <div class="form-group">
                <label for="prec">Precio:</label>
                <input type="text"   name="precio" required>
            </div>
            <div class="form-group">
                <label for="cant">Cantidad en stock:</label>
                <input type="text" name="cantidad" required>
            </div>
            <div class="form-group">
            <label for="ima">Cargar imagen:</label>
            <input type="file" name="imageni" required>
            </div>
            <div class="form-group">
            <input type="submit" name="accion" value="Agregar producto">
            </div>
        </form>
        
</body>
</html>