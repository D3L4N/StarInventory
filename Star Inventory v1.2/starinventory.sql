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
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    Usuario VARCHAR(50) NOT NULL,
    Contraseña VARCHAR(255) NOT NULL,
    Rol_Usuario VARCHAR(50),
    Fecha_Registro DATETIME NOT NULL, 
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
    ('Electrónica'),
    ('Ropa'),
    ('Hogar');

-- Inserción de datos de ejemplo en la tabla de Subcategoría
INSERT INTO Subcategoria (Nombre_Subcategoria, ID_Categoria) VALUES
    ('Teléfonos', 1),
    ('Televisores', 1),
    ('Pantalones', 2),
    ('Camisetas', 2),
    ('Muebles', 3),
    ('Electrodomésticos', 3);

-- Inserción de datos de ejemplo en la tabla de Proveedor
INSERT INTO Proveedor (Nombre_Proveedor, Numero_Contacto) VALUES
    ('Proveedor A', '123-456-7890'),
    ('Proveedor B', '987-654-3210'),
    ('Proveedor C', '555-555-5555');

-- Inserción de datos de ejemplo en la tabla de Usuario
INSERT INTO Usuario (Nombre, Apellido, Usuario, Contraseña, Rol_Usuario, Fecha_Registro, Foto_Perfil) VALUES
    ('Juan', 'Pérez', 'juanperez', 'D4584547C7F6A01A40BB8D863AB2C134E0C51CE353C0CA2FD93857961D750658', 'Administrador', '2023-01-01 10:00:00', 'Foto_Perfil/Predeterminada.png'),
    ('Ana', 'López', 'analopez', 'D4584547C7F6A01A40BB8D863AB2C134E0C51CE353C0CA2FD93857961D750658', 'Cajero', '2023-01-02 11:00:00', 'Foto_Perfil/Predeterminada.png');
    ('Ana', 'Rincon', 'anarincon', 'D4584547C7F6A01A40BB8D863AB2C134E0C51CE353C0CA2FD93857961D750658', 'Bodeguero', '2023-01-02 11:00:00', 'Foto_Perfil/Predeterminada.png');


-- Inserción de datos de ejemplo en la tabla de Producto
INSERT INTO Producto (Nombre_Producto, Fecha_Caducidad, Precio, Stock, Imagen_Producto, Proveedor, Categoria, Subcategoria) VALUES
    ('Teléfono Samsung', NULL, 600000, NULL, 'Imagen_Producto/1694440168010.png', 1, 1, 1),
    ('Camiseta Deportiva', NULL, 29000, NULL, 'Imagen_Producto/1694440168010.png', 1, 1, 1),
    ('Set de Herramientas', NULL, 79000, NULL, 'Imagen_Producto/1694440168010.png', 1, 1, 1),
    ('Smart TV 55 Pulgadas', NULL, 599000, NULL, 'Imagen_Producto/1694440168010.png', 1, 1, 1)



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