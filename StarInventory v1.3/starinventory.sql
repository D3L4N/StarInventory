-- Tabla de CATEGORÍA 
CREATE TABLE Categoria (
    ID_Categoria INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Categoria VARCHAR(100) NULL
);

-- Tabla de SUBCATEGORÍA 
CREATE TABLE Subcategoria (
    ID_Subcategoria INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Subcategoria VARCHAR(100) NULL,
    ID_Categoria INT NULL,
    FOREIGN KEY (ID_Categoria) REFERENCES Categoria(ID_Categoria)
);

-- Tabla de PROVEEDORES 
CREATE TABLE Proveedor (
    ID_Proveedor INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Proveedor VARCHAR(100) NULL,
    Numero_Contacto VARCHAR(20) NULL
);

-- Tabla de USUARIOS 
CREATE TABLE Usuario (
    ID_Usuario INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NULL,
    Apellido VARCHAR(50) NULL,
    Usuario VARCHAR(50) NULL,
    Contraseña VARCHAR(255) NULL,
    Rol_Usuario VARCHAR(50),
    Fecha_Registro DATETIME NULL, 
    Foto_Perfil TEXT
);

-- Tabla de PRODUCTOS 
CREATE TABLE Producto (
    ID_Producto INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Producto VARCHAR(100) NULL,
    Fecha_Caducidad DATE NULL,
    Precio DECIMAL(10, 0) NULL,
    Stock INT NULL,
    Imagen_Producto TEXT NULL,
    Proveedor INT NULL,
    Categoria INT NULL,
    Subcategoria INT NULL,
    FOREIGN KEY (Proveedor) REFERENCES Proveedor(ID_Proveedor),
    FOREIGN KEY (Categoria) REFERENCES Categoria(ID_Categoria),
    FOREIGN KEY (Subcategoria) REFERENCES Subcategoria(ID_Subcategoria)
);

-- Tabla de ENTRADAS DE PRODUCTOS 
CREATE TABLE Compra (
    ID_Compra INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Producto VARCHAR(100) NULL,
    Stock INT NULL,
    Fecha_Compra DATETIME NULL, 
    Nombre_Proveedor VARCHAR(100) NULL,
    Nombre_Usuario VARCHAR(100) NULL,
    Precio_Total DECIMAL(10, 0) NULL
);

-- Tabla de SALIDAS DE PRODUCTOS 
CREATE TABLE Venta (
    ID_Venta INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Producto VARCHAR(100),
    Stock INT NULL,
    Fecha_Venta DATETIME NULL, 
    Nombre_Usuario VARCHAR(100) NULL,
    Precio DECIMAL(10, 0) NULL
);

-- Tabla de DEVOLUCIONES 
CREATE TABLE Devolucion (
    ID_Devolucion INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Producto VARCHAR(100) NULL,
    Stock INT NULL,
    Fecha_Devolucion DATETIME NULL, 
    Nombre_Usuario VARCHAR(100)  NULL,
    Motivo VARCHAR(255) NULL
);



-- Inserción de datos de ejemplo en la tabla de Categoría
INSERT INTO Categoria (Nombre_Categoria) VALUES
    ('Lacteos'),
    ('Salsas'),
    ('Harinas');

-- Inserción de datos de ejemplo en la tabla de Subcategoría
INSERT INTO Subcategoria (Nombre_Subcategoria, ID_Categoria) VALUES
    ('Leche', 1),
    ('Queso', 1),
    ('Tomate', 2),
    ('Mayonesa', 2),
    ('Trigo', 3),
    ('Maiz', 3);

-- Inserción de datos de ejemplo en la tabla de Proveedor
INSERT INTO Proveedor (Nombre_Proveedor, Numero_Contacto) VALUES
    ('Alqueria', '123-456-7890'),
    ('Fruco', '987-654-3210'),
    ('Arina Pan', '555-555-5555'),
    ('la cuajada', '666-666-6666');

-- Inserción de datos de ejemplo en la tabla de Usuario
INSERT INTO Usuario (Nombre, Apellido, Usuario, Contraseña, Rol_Usuario, Fecha_Registro, Foto_Perfil) VALUES
    ('Administrador', 'Administrador', 'Administrador', 'd4584547c7f6a01a40bb8d863ab2c134e0c51ce353c0ca2fd93857961d750658', 'Administrador', '2023-01-01 10:00:00', 'Foto_Perfil/Predeterminada.jpg'),
    ('Cajero', 'Cajero', 'Cajero', 'c9ab9642593648445f043104a3dfade60ffaf26f66218d37c6eb7ce52f14297e', 'Cajero', '2023-01-02 11:00:00', 'Foto_Perfil/Predeterminada.jpg'),
    ('Bodeguero', 'Bodeguero', 'Bodeguero', '8a998cbcf9dd150a8e907448450929e69a15b4c01dd48326e6bcc94dbef38352', 'Bodeguero', '2023-01-02 11:00:00', 'Foto_Perfil/Predeterminada.jpg');


-- Inserción de datos de ejemplo en la tabla de Producto
INSERT INTO Producto (Nombre_Producto, Fecha_Caducidad, Precio, Stock, Imagen_Producto, Proveedor, Categoria, Subcategoria) VALUES
    ('Leche Alqueria 1L', "1940/01/01", 5000, "0", 'Imagen_Producto/Leche.png', 1, 1, 1),
    ('Harina de Maiz 35gr', "1940/01/01", 4500, "0", 'Imagen_Producto/Harina.png', 3, 3, 5),
    ('Salsa Fruco Tomate 600gr', "1940/01/01", 3000, "0", 'Imagen_Producto/Salsa.png', 2, 2, 3),
    ('1/4, Queso Bloque 550gr', "1940/01/01", 2000, "0", 'Imagen_Producto/Queso.png', 4, 1, 2)



--DROP EVENT IF EXISTS ReiniciarTablaCompra;

DELIMITER $$
CREATE EVENT ReiniciarTablaCompra
ON SCHEDULE EVERY 1 DAY
STARTS TIMESTAMP(CURRENT_DATE, '00:00:00')
DO
BEGIN
    TRUNCATE TABLE Compra;
END;
$$
DELIMITER ;

DELIMITER $$
CREATE EVENT ReiniciarTablaVenta
ON SCHEDULE EVERY 1 DAY
STARTS TIMESTAMP(CURRENT_DATE, '00:00:00')
DO
BEGIN
    TRUNCATE TABLE Venta;
END;
$$
DELIMITER ;

DELIMITER $$
CREATE EVENT ReiniciarTablaDevolucion
ON SCHEDULE EVERY 1 DAY
STARTS TIMESTAMP(CURRENT_DATE, '00:00:00')
DO
BEGIN
    TRUNCATE TABLE Devolucion;
END;
$$
DELIMITER ;