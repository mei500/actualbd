-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS asignacion;

-- Seleccionar la base de datos
USE asignacion;

-- Crear la tabla activo_ine
CREATE TABLE IF NOT EXISTS activo_ine (
    pkactivo INT(11) AUTO_INCREMENT PRIMARY KEY,
    codigo TEXT,
    codigo_nuevo TEXT,
    descripcion TEXT,
    serie TEXT,
    cantidad INT(11),
    estado_activo TEXT,
    observacion TEXT,
    unidad VARCHAR(10),
    mobiliario VARCHAR(10),
    financiamiento TEXT,
    financiamiento_act VARCHAR(10),
    custodio TEXT,
    ci TEXT,
    cargo TEXT,
    departamento TEXT,
    ubicacion TEXT,
    oficina TEXT,
    fecha TEXT,
    objeto TEXT,
    tipo TEXT,
    gestion_compra TEXT,
    fechacre TEXT,
    horacre TEXT,
    fechaact TEXT,
    horaact TEXT,
    fechaelm TEXT,
    horaelm TEXT,
    estado INT(11),
    Revision SET('Revisar', 'Verificado', 'Informe')
);

-- Crear la tabla persona
CREATE TABLE IF NOT EXISTS persona (
    pkpersona INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre TEXT,
    apellidos TEXT,
    ci TEXT,
    expedido TINYTEXT,
    celular1 TINYTEXT,
    celular2 TINYTEXT,
    direccion TEXT,
    correo TINYTEXT,
    fechanacimiento TINYTEXT,
    fkprofesion INT(11),
    fknivelpro INT(11),
    imagen TINYTEXT,
    fechacre TINYTEXT,
    horacre TINYTEXT,
    fechaact TINYTEXT,
    horaact TINYTEXT,
    fechaelm TINYTEXT,
    horaelm TINYTEXT,
    estado INT(2)
);

-- Crear la tabla asignacion_activo
CREATE TABLE IF NOT EXISTS asignacion_activo (
    id_asignacion INT(11) AUTO_INCREMENT PRIMARY KEY,
    as_persona INT(11),
    as_activo INT(11),
    ubicacion VARCHAR(255),
    fecha DATE,
    FOREIGN KEY (as_persona) REFERENCES persona(pkpersona),
    FOREIGN KEY (as_activo) REFERENCES activo_ine(pkactivo)
);



--crear tabla historial_asignacion_activo

 
    CREATE TABLE IF NOT EXISTS historial_asignacion_activo (
    id_historial INT AUTO_INCREMENT PRIMARY KEY,
    id_asignacion_nuevo INT,
    as_persona_nuevo VARCHAR(255),
    as_activo_nuevo VARCHAR(255),
    ubicacion_nuevo VARCHAR(255),
    fecha_nuevo DATE,
    id_asignacion_antiguo INT,
    as_persona_antiguo VARCHAR(255),
    as_activo_antiguo VARCHAR(255),
    ubicacion_antiguo VARCHAR(255),
    fecha_antiguo DATE,
    fecha_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_asignacion_nuevo) REFERENCES asignacion_activo(id_asignacion)
);



-- Insertar datos aleatorios en la tabla activo_ine
INSERT INTO activo_ine (codigo, codigo_nuevo, descripcion, serie, cantidad, estado_activo, observacion, unidad, mobiliario, financiamiento, financiamiento_act, custodio, ci, cargo, departamento, ubicacion, oficina, fecha, objeto, tipo, gestion_compra, fechacre, horacre, fechaact, horaact, fechaelm, horaelm, estado, Revision) 
SELECT 
    CONCAT('COD', FLOOR(RAND() * 10000)), 
    CONCAT('CODN', FLOOR(RAND() * 10000)), 
    CONCAT('Descripción ', FLOOR(RAND() * 100)), 
    CONCAT('Serie', FLOOR(RAND() * 100)), 
    FLOOR(RAND() * 10) + 1, 
    CASE WHEN RAND() < 0.5 THEN 'Bueno' ELSE 'Malo' END, 
    CONCAT('Observación ', FLOOR(RAND() * 100)), 
    CASE WHEN RAND() < 0.5 THEN 'Unidad1' ELSE 'Unidad2' END, 
    CASE WHEN RAND() < 0.5 THEN 'Mobiliario1' ELSE 'Mobiliario2' END, 
    CASE WHEN RAND() < 0.5 THEN 'Financiamiento1' ELSE 'Financiamiento2' END, 
    CASE WHEN RAND() < 0.5 THEN 'FinanciamientoAct1' ELSE 'FinanciamientoAct2' END, 
    CONCAT('Custodio ', FLOOR(RAND() * 100)), 
    CONCAT('CI', FLOOR(RAND() * 10000)), 
    CONCAT('Cargo ', FLOOR(RAND() * 100)), 
    CONCAT('Departamento ', FLOOR(RAND() * 100)), 
    CONCAT('Ubicación ', FLOOR(RAND() * 100)), 
    CONCAT('Oficina ', FLOOR(RAND() * 100)), 
    CONCAT('2023-01-', LPAD(FLOOR(RAND() * 30) + 1, 2, '0')), 
    CONCAT('Objeto ', FLOOR(RAND() * 100)), 
    CASE WHEN RAND() < 0.5 THEN 'Tipo1' ELSE 'Tipo2' END, 
    CONCAT('Gestión de compra ', FLOOR(RAND() * 100)), 
    '2023-01-01', 
    '12:00:00', 
    '2023-01-01', 
    '12:00:00', 
    '2023-01-01', 
    '12:00:00', 
    1, 
    CASE 
        WHEN RAND() < 0.33 THEN 'Revisar' 
        WHEN RAND() < 0.66 THEN 'Verificado' 
        ELSE 'Informe' 
    END
FROM 
    (SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10) as a
    CROSS JOIN 
    (SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4) as b;

-- Insertar datos aleatorios en la tabla persona
INSERT INTO persona (nombre, apellidos, ci, expedido, celular1, celular2, direccion, correo, fechanacimiento, fkprofesion, fknivelpro, imagen, fechacre, horacre, fechaact, horaact, fechaelm, horaelm, estado)
SELECT 
    CONCAT('Nombre', FLOOR(RAND() * 100)), 
    CONCAT('Apellido', FLOOR(RAND() * 100)), 
    CONCAT('CI', FLOOR(RAND() * 10000)), 
    'Exp', 
    CONCAT('Cel1', FLOOR(RAND() * 10000)), 
    CONCAT('Cel2', FLOOR(RAND() * 10000)), 
    CONCAT('Dirección', FLOOR(RAND() * 100)), 
    CONCAT('correo', FLOOR(RAND() * 100)), 
    CONCAT('1990-01-', LPAD(FLOOR(RAND() * 30) + 1, 2, '0')), 
    FLOOR(RAND() * 5) + 1, 
    FLOOR(RAND() * 5) + 1, 
    'imagen', 
    '2023-01-01', 
    '12:00:00', 
    '2023-01-01', 
    '12:00:00', 
    '2023-01-01', 
    '12:00:00', 
    1
FROM 
    (SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5) as a;

-- Imprimir mensajes de confirmación
SELECT 'Se han insertado datos en la tabla activo_ine' as 'Mensaje';
SELECT 'Se han insertado datos en la tabla persona' as 'Mensaje';
