DROP DATABASE IF EXISTS ReTradeX;
CREATE DATABASE ReTradeX;
USE ReTradeX;

CREATE TABLE Clientes (
	IdCliente int(5) AUTO_INCREMENT,
	Nombre varchar(40) NOT NULL,
    Apellido varchar(40) NOT NULL,
    Apodo varchar(20) NOT NULL,
    Direccion varchar(80) NOT NULL,
    Pais varchar(20) NOT NULL,
	CP varchar(9) NOT NULL,
	Correo varchar(40) NOT NULL,
	DNI varchar(12) NOT NULL,
	Telefono varchar(15) NOT NULL,
	Clave varchar(50) NOT NULL,
	Saldo float(5),
	Admin char(1),
	CONSTRAINT pk_Clientes PRIMARY KEY (IdCliente)
);

CREATE TABLE Noticias (
	IdNoticia int(5) AUTO_INCREMENT,
	Fecha varchar(20) NOT NULL,
	Titulo varchar(50) NOT NULL,
	Texto varchar(21000) NOT NULL,
	Fuente varchar(40) NOT NULL,
	Categoria varchar(200) NOT NULL,
    Foto varchar(70) NOT NULL,
	CONSTRAINT pk_Noticias PRIMARY KEY (IdNoticia)
);

CREATE TABLE Productos (
	IdProducto int(5) AUTO_INCREMENT,
	Fecha varchar(20) NOT NULL,
	Nombre varchar(50) NOT NULL,
	Precio float(7) NOT NULL,
	Descripcion varchar(21000) NOT NULL,
	Foto varchar(70) NOT NULL,
	Foto1 varchar(70) NOT NULL,
    Foto2 varchar(70) NOT NULL,
	Foto3 varchar(70) NOT NULL,
    Foto4 varchar(70) NOT NULL,
	CONSTRAINT pk_Productos PRIMARY KEY (IdProducto)
);

CREATE TABLE Foro (
	IdForo int(5) AUTO_INCREMENT,
	Fecha varchar(20) NOT NULL,
	Titulo varchar(50) NOT NULL,
	Descripcion varchar(5000) NOT NULL,
    Icono varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
	CONSTRAINT pk_Foro PRIMARY KEY (IdForo)
);

CREATE TABLE Contacto (
	IdContacto int(5) AUTO_INCREMENT,
	Fecha varchar(20) NOT NULL,
	Nombre varchar(50) NOT NULL,
	Apellido varchar(50) NOT NULL,
	Direccion varchar(50) NOT NULL,
	Correo varchar(50) NOT NULL,
	Telefono varchar(10) NOT NULL,
	Descripcion varchar(500) NOT NULL,
	CONSTRAINT pk_Contacto PRIMARY KEY (IdContacto)
);

CREATE TABLE Entradas (
	IdEntrada int(5) AUTO_INCREMENT,
	Fecha varchar(20) NOT NULL,
	Texto varchar(21000) NOT NULL,
	IdForo int(5) NOT NULL,
	IdCliente int(5) NOT NULL,
	CONSTRAINT pk_IdEntrada PRIMARY KEY (IdEntrada),
	CONSTRAINT fk_IdForo FOREIGN KEY (IdForo)
		REFERENCES Foro(IdForo)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
    CONSTRAINT fk_IdCliente FOREIGN KEY (IdCliente)
		REFERENCES Clientes(IdCliente)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
);

CREATE TABLE Compras (
	IdCompra int(5) AUTO_INCREMENT,
	Fecha varchar(20) NOT NULL,
	Cantidad varchar(5) NOT NULL,
	IdProducto int(5) NOT NULL,
	IdCliente int(5) NOT NULL,
	CONSTRAINT pk_IdCompra PRIMARY KEY (IdCompra),
	CONSTRAINT fk_IdProductoCompras FOREIGN KEY (IdProducto)
		REFERENCES Productos(IdProducto)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
    CONSTRAINT fk_IdClienteCompras FOREIGN KEY (IdCliente)
		REFERENCES Clientes(IdCliente)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
);

CREATE TABLE Activos (
	IdActivo int(5) AUTO_INCREMENT,
	Fecha varchar(20) NOT NULL,
	Precio float(20) NOT NULL,
	Cantidad varchar(20) NOT NULL,
	Nombre varchar(20) NOT NULL,
	IdCliente int(5) NOT NULL,
	CONSTRAINT pk_IdActivo PRIMARY KEY (IdActivo),
    CONSTRAINT fk_IdClienteActivos FOREIGN KEY (IdCliente)
		REFERENCES Clientes(IdCliente)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
);


DROP USER IF EXISTS 'ReTradeX';
CREATE USER 'ReTradeX' IDENTIFIED BY 'ReTradeX';

GRANT ALL ON ReTradeX.* to 'ReTradeX';

INSERT INTO Clientes(Nombre, Apellido, Apodo, Direccion, Pais, CP, Correo, DNI, Telefono, Clave, Saldo)
 VALUES ('Anuar', 'Iziani', 'Anuar007', 'Avenida Bulevar de El Ejido 123, Almeria', 'España', '04700', 'anuar@gmail.com', '12345678A', '666333222', md5('anuar'), 50);
INSERT INTO Clientes(Nombre, Apellido, Apodo, Direccion, Pais, CP, Correo, DNI, Telefono, Clave, Saldo)
 VALUES ('Juan', 'Torres', 'JuaanXo', 'Calle Multicolor 342 1º, Valencia', 'España', '04710', 'juanxo123@gmail.com', '12345678A', '666333222', md5('juanxo'), 50);
INSERT INTO Clientes(Nombre, Apellido, Apodo, Direccion, Pais, CP, Correo, DNI, Telefono, Clave, Saldo)
 VALUES ('Maria', 'Perez', 'Mar22', 'Calle Madrid 34, Madrid', 'España', '04700', 'marrr32@gmail.com', '12345678A', '666333222', md5('maria'), 50);
INSERT INTO Clientes(Nombre, Apellido, Apodo, Direccion, Pais, CP, Correo, DNI, Telefono, Clave, Saldo)
 VALUES ('Antonio', 'Martín', 'Toni', 'Calle cervantes, Valencia', 'España', '06200', 'antonio@gmail.com', '12345678A', '666333222', md5('antonio'), 50);
INSERT INTO Clientes(Nombre, Apellido, Apodo, Direccion, Pais, CP, Correo, DNI, Telefono, Clave, Saldo)
 VALUES ('Marta', 'Fernandez', 'Marta20', 'Avenida principal 42 , Barcelona', 'España', '02410', 'marta@gmail.com', '12345678A', '666333222', md5('marta'), 50);
INSERT INTO Clientes(Nombre, Apellido, Apodo, Direccion, Pais, CP, Correo, DNI, Telefono, Clave, Saldo)
 VALUES ('Eduardo', 'Sanhcez', 'Elcrack12', 'Calle Estudio 34, Tarragona', 'España', '03500', 'eduardo@gmail.com', '12345678A', '666333222', md5('eduardo'), 50);
 
--Insertar desde PhpMyAdmin para poder ver los emojis
INSERT INTO Foro (Fecha, Titulo, Descripcion, Icono) VALUES 
	('12/12/2022', 'Dudas sobre compra y venta de valores', 'Aqui hablaremos sobre las dudas que surgen a la hora de comprar y vender','📈');
INSERT INTO Foro (Fecha, Titulo, Descripcion, Icono) VALUES 
	('12/12/2022', 'Ingresar y retirar dinero', 'Intentaremos explicar como se ingresa y se retira dinero desde nuestra cartera','💳');
INSERT INTO Foro (Fecha, Titulo, Descripcion, Icono) VALUES 
	('12/12/2022', 'Nuevas divisas', '¿Cuando habrás nuevas divisas y activos disponibles?','💶');
INSERT INTO Foro (Fecha, Titulo, Descripcion, Icono) VALUES 
	('12/12/2022', '¿Porqué no es bueno copiar operaciones?', 'Se habla mucho de que no es bueno copiar operaciones, que opináis?','🚫');
INSERT INTO Foro (Fecha, Titulo, Descripcion, Icono) VALUES 
	('12/12/2022', 'Horarios de mercado', 'Alguien me puede decir los horarios de cada mercado?','⌚');
INSERT INTO Foro (Fecha, Titulo, Descripcion, Icono) VALUES 
	('12/12/2022', 'Bono de bienvenida', 'Actualmente se dan 50€ de bono de bienvenida','🎁');
INSERT INTO Foro (Fecha, Titulo, Descripcion, Icono) VALUES 
	('12/12/2022', '¿Invertir es jugar al azar?', 'Porque invertir no jugar al azar? Vuestros argumentos?','🎲');
INSERT INTO Foro (Fecha, Titulo, Descripcion, Icono) VALUES 
	('12/12/2022', 'Estudios requeridos para invertir', 'Que hay que estudiar para poder invertir','🎓');
INSERT INTO Foro (Fecha, Titulo, Descripcion, Icono) VALUES 
	('12/12/2022', 'Libros sobre inversión y trading', 'Dejad los libros que hayáis leido y merezcan la pena. Empiezo yo: Padre rico, padre pobre','📚');

INSERT INTO Productos (Fecha,Nombre,Precio,Descripcion,Foto,Foto1,Foto2,Foto3,Foto4) VALUES
	('14 de junio de 2023','Almohada','14.99','Descubre la elegancia y versatilidad de nuestra mochila blanca ReTradeX, la compañera perfecta para tus aventuras diarias. Diseñada pensando en la comodidad y el estilo, esta mochila te brindará tanto funcionalidad como un toque moderno a tu look.','../Imagenes/Almohada/foto.png','../Imagenes/Almohada/foto1.png','../Imagenes/Almohada/foto2.png','../Imagenes/Almohada/foto3.png','../Imagenes/Almohada/foto4.png');
INSERT INTO Productos (Fecha,Nombre,Precio,Descripcion,Foto,Foto1,Foto2,Foto3,Foto4) VALUES
	('14 de junio de 2023','Bolsa','8.99','Descubre la elegancia y versatilidad de nuestra mochila blanca ReTradeX, la compañera perfecta para tus aventuras diarias. Diseñada pensando en la comodidad y el estilo, esta mochila te brindará tanto funcionalidad como un toque moderno a tu look.','../Imagenes/Bolsa/foto.png','../Imagenes/Bolsa/foto1.png','../Imagenes/Bolsa/foto2.png','../Imagenes/Bolsa/foto3.png','../Imagenes/Bolsa/foto4.png');
INSERT INTO Productos (Fecha,Nombre,Precio,Descripcion,Foto,Foto1,Foto2,Foto3,Foto4) VALUES
	('14 de junio de 2023','Botella','5.99','Descubre la elegancia y versatilidad de nuestra mochila blanca ReTradeX, la compañera perfecta para tus aventuras diarias. Diseñada pensando en la comodidad y el estilo, esta mochila te brindará tanto funcionalidad como un toque moderno a tu look.','../Imagenes/Botella/foto.png','../Imagenes/Botella/foto1.png','../Imagenes/Botella/foto2.png','../Imagenes/Botella/foto3.png','../Imagenes/Botella/foto4.png');
INSERT INTO Productos (Fecha,Nombre,Precio,Descripcion,Foto,Foto1,Foto2,Foto3,Foto4) VALUES
	('14 de junio de 2023','Handbag','11.99','Descubre la elegancia y versatilidad de nuestra mochila blanca ReTradeX, la compañera perfecta para tus aventuras diarias. Diseñada pensando en la comodidad y el estilo, esta mochila te brindará tanto funcionalidad como un toque moderno a tu look.','../Imagenes/Handbag/foto.png','../Imagenes/Handbag/foto1.png','../Imagenes/Handbag/foto2.png','../Imagenes/Handbag/foto3.png','../Imagenes/Handbag/foto4.png');
INSERT INTO Productos (Fecha,Nombre,Precio,Descripcion,Foto,Foto1,Foto2,Foto3,Foto4) VALUES
	('14 de junio de 2023','Libreta','2.99','Descubre la elegancia y versatilidad de nuestra mochila blanca ReTradeX, la compañera perfecta para tus aventuras diarias. Diseñada pensando en la comodidad y el estilo, esta mochila te brindará tanto funcionalidad como un toque moderno a tu look.','../Imagenes/Libreta/foto.png','../Imagenes/Libreta/foto1.png','../Imagenes/Libreta/foto2.png','../Imagenes/Libreta/foto3.png','../Imagenes/Libreta/foto4.png');
INSERT INTO Productos (Fecha,Nombre,Precio,Descripcion,Foto,Foto1,Foto2,Foto3,Foto4) VALUES
	('14 de junio de 2023','Saco','4.99','Descubre la elegancia y versatilidad de nuestra mochila blanca ReTradeX, la compañera perfecta para tus aventuras diarias. Diseñada pensando en la comodidad y el estilo, esta mochila te brindará tanto funcionalidad como un toque moderno a tu look.','../Imagenes/Saco/foto.png','../Imagenes/Saco/foto1.png','../Imagenes/Saco/foto2.png','../Imagenes/Saco/foto3.png','../Imagenes/Saco/foto4.png');
INSERT INTO Productos (Fecha,Nombre,Precio,Descripcion,Foto,Foto1,Foto2,Foto3,Foto4) VALUES
	('14 de junio de 2023','Mochila','19.99','Descubre la elegancia y versatilidad de nuestra mochila blanca ReTradeX, la compañera perfecta para tus aventuras diarias. Diseñada pensando en la comodidad y el estilo, esta mochila te brindará tanto funcionalidad como un toque moderno a tu look.','../Imagenes/Mochila/foto.png','../Imagenes/Mochila/foto1.png','../Imagenes/Mochila/foto2.png','../Imagenes/Mochila/foto3.png','../Imagenes/Mochila/foto4.png');
INSERT INTO Productos (Fecha,Nombre,Precio,Descripcion,Foto,Foto1,Foto2,Foto3,Foto4) VALUES
	('14 de junio de 2023','Taza','4.99','Descubre la elegancia y versatilidad de nuestra mochila blanca ReTradeX, la compañera perfecta para tus aventuras diarias. Diseñada pensando en la comodidad y el estilo, esta mochila te brindará tanto funcionalidad como un toque moderno a tu look.','../Imagenes/Taza/foto.png','../Imagenes/Taza/foto1.png','../Imagenes/Taza/foto2.png','../Imagenes/Taza/foto3.png','../Imagenes/Taza/foto4.png');
INSERT INTO Productos (Fecha,Nombre,Precio,Descripcion,Foto,Foto1,Foto2,Foto3,Foto4) VALUES
	('14 de junio de 2023','Vaso','0.99','Descubre la elegancia y versatilidad de nuestra mochila blanca ReTradeX, la compañera perfecta para tus aventuras diarias. Diseñada pensando en la comodidad y el estilo, esta mochila te brindará tanto funcionalidad como un toque moderno a tu look.','../Imagenes/Vaso/foto.png','../Imagenes/Vaso/foto1.png','../Imagenes/Vaso/foto2.png','../Imagenes/Vaso/foto3.png','../Imagenes/Vaso/foto4.png');

INSERT INTO Noticias (Fecha,Titulo,Texto,Fuente,Categoria,Foto) VALUES
	('14 de mayo de 2023','Reunión de la FED','En una reunión clave celebrada hoy, la Reserva Federal de Estados Unidos se ha reunido para discutir y evaluar las políticas económicas y las tasas de interés del país. El encuentro, que tuvo lugar en la sede del banco central en Washington D.C., reunió a los miembros del Comité Federal de Mercado Abierto (FOMC, por sus siglas en inglés), encargados de tomar decisiones sobre la política monetaria de la nación.La Reserva Federal, bajo la presidencia de su líder actual, ha desempeñado un papel fundamental en la gestión de la economía estadounidense, buscando un equilibrio entre el fomento del crecimiento económico y el control de la inflación. En la reunión, se examinaron diversos indicadores económicos, desde el empleo y la producción hasta los precios y la estabilidad financiera, para evaluar la salud general de la economía. Uno de los temas centrales de la reunión fue el ajuste de las tasas de interés. Los miembros del FOMC analizaron detenidamente los datos económicos recientes y debatieron las posibles medidas a tomar. Si bien no se ha revelado ninguna decisión concreta al respecto, se espera que las discusiones se centren en la continuidad de la política actual o la posibilidad de realizar cambios graduales en las tasas de interés para adaptarse a las condiciones económicas cambiantes.La comunidad financiera y los mercados globales están atentos a las declaraciones y comunicados de prensa que se emitan después de la reunión, en busca de indicios sobre las decisiones de política monetaria y las perspectivas económicas. Cualquier cambio en las políticas de la Reserva Federal puede tener un impacto significativo en los mercados financieros, así como en las tasas de interés a nivel nacional e internacional. La próxima reunión del FOMC está programada para dentro de unos meses, y se espera que brinde una mayor claridad sobre las acciones que tomará la Reserva Federal para respaldar el crecimiento sostenible de la economía y mantener la estabilidad monetaria. La Reserva Federal de Estados Unidos continúa ejerciendo su papel crucial en la gestión de la política monetaria y la supervisión del sistema bancario del país. Sus decisiones y acciones seguirán siendo un factor clave para los mercados y la economía en general, mientras se esfuerza por mantener un equilibrio entre el crecimiento y la estabilidad económica.',
	'TheEconomist','Macroeconomía','../Imagenes/noticia1.png');
INSERT INTO Noticias (Fecha,Titulo,Texto,Fuente,Categoria,Foto) VALUES
	('3 de mayo de 2023','Suben el tipo de interés','En una medida contundente para abordar las crecientes preocupaciones sobre la inflación y mantener el control económico, el Banco Central de Estados Unidos ha decidido subir el tipo de interés. La Reserva Federal ha anunciado hoy un aumento de 0.25 puntos porcentuales, llevando el tipo de interés clave a un nuevo nivel. Esta acción se produce en medio de una economía estadounidense que muestra signos de fortaleza y un aumento sostenido en los precios al consumidor. La Reserva Federal ha estado observando de cerca los indicadores económicos y, tras un análisis exhaustivo, ha determinado que es necesario tomar medidas para evitar una espiral inflacionaria. El aumento del tipo de interés tiene como objetivo principal enfriar la economía y desacelerar el gasto y la inversión. Al aumentar el costo del endeudamiento, se espera que los consumidores y las empresas piensen dos veces antes de tomar préstamos y realicen compras impulsivas. Esto, a su vez, reduce la demanda y ayuda a frenar el aumento de los precios. Sin embargo, esta medida no está exenta de consecuencias. Si bien la subida del tipo de interés puede ayudar a controlar la inflación, también puede afectar a los sectores de la economía que dependen del crédito y la financiación barata. Los préstamos hipotecarios, los préstamos para automóviles y otros productos financieros vinculados al tipo de interés se verán afectados, lo que puede desacelerar el crecimiento en esos sectores. El presidente de la Reserva Federal ha declarado que esta acción es necesaria para asegurar un crecimiento económico sostenible y evitar riesgos a largo plazo. Aunque puede haber cierta volatilidad en los mercados financieros en el corto plazo debido a esta decisión, se espera que la economía se ajuste gradualmente a este nuevo escenario. Los efectos de este aumento en el tipo de interés también se sentirán a nivel global. Los flujos de capital pueden desplazarse hacia Estados Unidos en busca de mayores rendimientos, lo que podría afectar a otras economías. Los bancos centrales de otros países pueden verse presionados para seguir los pasos de la Reserva Federal y aumentar sus propias tasas de interés. En conclusión, el aumento del tipo de interés anunciado por el Banco Central de Estados Unidos refleja su compromiso de mantener la estabilidad económica y controlar la inflación. Si bien esta medida puede tener un impacto en varios sectores y en la economía mundial, se espera que ayude a mantener un crecimiento sostenible y a proteger el poder adquisitivo de los consumidores a largo plazo.',
	'Wall Street Journal','Macroeconomía','../Imagenes/noticia2.png');
INSERT INTO Noticias (Fecha,Titulo,Texto,Fuente,Categoria,Foto) VALUES
	('1 de mayo de 2023','El oro sube un 5%','En un movimiento inesperado, el precio del oro experimentó un notable aumento del 5% en los mercados internacionales esta semana. Esta sorpresiva alza ha captado la atención de inversores y analistas, quienes buscan entender los factores detrás de este incremento en el valor del preciado metal. El oro, considerado tradicionalmente como un refugio seguro en tiempos de incertidumbre económica, ha encontrado un nuevo impulso en medio de crecientes preocupaciones globales. La persistente volatilidad de los mercados financieros, las tensiones comerciales entre potencias mundiales y la incertidumbre en torno a la recuperación económica post-pandemia son algunos de los elementos que han impulsado a los inversionistas a buscar refugio en activos más seguros. El metal dorado alcanzó su nivel más alto en los últimos meses, superando la barrera de los $1,800 por onza. Este repunte en su valor ha llamado la atención de inversores institucionales y minoristas por igual, quienes buscan proteger sus carteras de posibles riesgos y aprovechar las oportunidades que ofrece el mercado del oro. Expertos financieros han señalado que la reciente depreciación del dólar estadounidense también ha contribuido al alza del oro. A medida que la moneda norteamericana se debilita, el oro se vuelve más atractivo para los inversores, ya que su precio se cotiza en dólares. Esto ha impulsado la demanda de oro en los mercados internacionales y ha influido en su notable incremento. Si bien el aumento del 5% en el precio del oro ha generado expectativas entre los inversores, algunos analistas advierten que esta tendencia podría no ser sostenible a largo plazo. La evolución de la situación económica global, la respuesta de los bancos centrales y las políticas monetarias de los principales países serán factores clave que determinarán la dirección futura del mercado del oro. En conclusión, el oro ha experimentado un sorprendente incremento del 5%, impulsado por la incertidumbre económica global y el debilitamiento del dólar estadounidense. Este aumento ha generado un renovado interés por parte de los inversores en este metal precioso, aunque la sostenibilidad de esta tendencia dependerá de diversos factores económicos y políticos. Los mercados financieros permanecerán atentos a los acontecimientos futuros en busca de señales sobre la dirección del precio del oro y su impacto en la economía mundial.',
	'Bloomberg','Finanzas','../Imagenes/noticia3.png');
INSERT INTO Noticias (Fecha,Titulo,Texto,Fuente,Categoria,Foto) VALUES
	('1 de mayo de 2023','Sector tenológico y el oro','En un mercado altamente competitivo, las pequeñas empresas de tecnología están emergiendo como actores clave en el sector de servicios, gracias a su capacidad para innovar y adaptarse rápidamente a las demandas cambiantes de los consumidores. Este fenómeno, respaldado por los principios de la microeconomía, está redefiniendo el panorama empresarial y generando oportunidades económicas significativas. El crecimiento acelerado de estas pequeñas empresas se debe, en gran medida, a su enfoque centrado en la satisfacción del cliente y la oferta de soluciones personalizadas. Aprovechando su agilidad y capacidad para ofrecer productos y servicios especializados, estas empresas han logrado competir eficazmente con los actores más establecidos del mercado. Un estudio reciente realizado por un instituto de investigación económica reveló que el número de pequeñas empresas de tecnología ha experimentado un aumento del 25% en los últimos dos años. Esto se atribuye a la creciente demanda de servicios digitales, como desarrollo de software, consultoría tecnológica y marketing en línea. La capacidad de estas empresas para adaptarse rápidamente a las nuevas tendencias tecnológicas y satisfacer las necesidades específicas de los clientes les ha permitido ganar terreno en el mercado. Además, su enfoque en la eficiencia operativa y la optimización de costos ha resultado en precios competitivos, atrayendo a un número creciente de clientes y generando una mayor demanda de sus servicios. Este crecimiento en el sector de servicios ha generado empleo y ha impulsado la economía local en diversas regiones. Las pequeñas empresas de tecnología no solo están creando puestos de trabajo directos, sino que también están generando oportunidades indirectas para otros sectores relacionados, como el diseño gráfico, el soporte técnico y la logística. Sin embargo, este crecimiento también ha planteado desafíos para estas empresas en términos de gestión del crecimiento, mantenimiento de la calidad y competencia con empresas más grandes. Para seguir prosperando, las pequeñas empresas de tecnología deberán continuar invirtiendo en investigación y desarrollo, establecer alianzas estratégicas y mantenerse a la vanguardia de la innovación. En resumen, el crecimiento acelerado de las pequeñas empresas de tecnología en el sector de servicios demuestra cómo los principios de la microeconomía, como la adaptabilidad, la satisfacción del cliente y la eficiencia, pueden impulsar el éxito empresarial. Estas empresas están desafiando el statu quo y abriendo nuevas oportunidades económicas en el mercado actualmente competitivo.',
	'TheEconomist','Finanzas','../Imagenes/noticia5.png');
INSERT INTO Noticias (Fecha,Titulo,Texto,Fuente,Categoria,Foto) VALUES
	('11 de abril de 2023','Bitcoin alcanza récord histórico','En los últimos meses, el Bitcoin ha protagonizado un impresionante rally alcista, superando todas las expectativas y alcanzando un nuevo récord histórico. La criptomoneda más famosa del mundo ha conquistado los mercados financieros con su valor ascendente y ha despertado un renovado interés por parte de inversores y entusiastas. En la jornada de hoy, el Bitcoin alcanzó un hito significativo al superar la marca de los $80,000 por unidad. Este logro ha generado un sentimiento de euforia entre los inversionistas, quienes ven en esta criptomoneda una oportunidad de inversión rentable y de alta volatilidad. La creciente adopción del Bitcoin ha sido un factor clave en su desempeño. Cada vez más empresas, tanto pequeñas como grandes, han comenzado a aceptar Bitcoin como forma de pago, lo que ha aumentado su utilidad y legitimidad en el mundo real. Además, varios gigantes financieros han anunciado su entrada al mercado de criptomonedas, brindando mayor confianza y respaldo a esta forma de activo digital. Otro factor que impulsa el alza del Bitcoin es la demanda creciente por parte de inversores institucionales. Fondos de inversión, empresas y gestoras de activos están destinando una parte de sus carteras a esta criptomoneda, reconociendo su potencial como un activo de reserva de valor y cobertura contra la inflación. A pesar de su éxito, el Bitcoin sigue siendo objeto de debate y controversia. Los críticos señalan su volatilidad como un riesgo significativo y cuestionan su estatus como moneda real. Sin embargo, los defensores del Bitcoin argumentan que su tecnología subyacente, la cadena de bloques o blockchain, proporciona una forma segura y descentralizada de realizar transacciones, sin necesidad de intermediarios. A medida que el Bitcoin continúa su ascenso meteórico, los analistas e inversores se preguntan cuál será su próximo hito y si se mantendrá como una inversión rentable a largo plazo. La incertidumbre sigue rodeando al mercado de criptomonedas, pero la emoción y el interés en el Bitcoin no disminuyen. Los ojos de todo el mundo financiero están puestos en esta criptomoneda, esperando ver qué depara el futuro para el rey indiscutible del mundo cripto.',
	'CNBC','Criptomonedas','../Imagenes/noticia7.png');
INSERT INTO Noticias (Fecha,Titulo,Texto,Fuente,Categoria,Foto) VALUES
	('20 de mayo de 2023','Comercio global se recupera','En un mercado altamente competitivo, las pequeñas empresas de tecnología están emergiendo como actores clave en el sector de servicios, gracias a su capacidad para innovar y adaptarse rápidamente a las demandas cambiantes de los consumidores. Este fenómeno, respaldado por los principios de la microeconomía, está redefiniendo el panorama empresarial y generando oportunidades económicas significativas. El crecimiento acelerado de estas pequeñas empresas se debe, en gran medida, a su enfoque centrado en la satisfacción del cliente y la oferta de soluciones personalizadas. Aprovechando su agilidad y capacidad para ofrecer productos y servicios especializados, estas empresas han logrado competir eficazmente con los actores más establecidos del mercado. Un estudio reciente realizado por un instituto de investigación económica reveló que el número de pequeñas empresas de tecnología ha experimentado un aumento del 25% en los últimos dos años. Esto se atribuye a la creciente demanda de servicios digitales, como desarrollo de software, consultoría tecnológica y marketing en línea. La capacidad de estas empresas para adaptarse rápidamente a las nuevas tendencias tecnológicas y satisfacer las necesidades específicas de los clientes les ha permitido ganar terreno en el mercado. Además, su enfoque en la eficiencia operativa y la optimización de costos ha resultado en precios competitivos, atrayendo a un número creciente de clientes y generando una mayor demanda de sus servicios. Este crecimiento en el sector de servicios ha generado empleo y ha impulsado la economía local en diversas regiones. Las pequeñas empresas de tecnología no solo están creando puestos de trabajo directos, sino que también están generando oportunidades indirectas para otros sectores relacionados, como el diseño gráfico, el soporte técnico y la logística. Sin embargo, este crecimiento también ha planteado desafíos para estas empresas en términos de gestión del crecimiento, mantenimiento de la calidad y competencia con empresas más grandes. Para seguir prosperando, las pequeñas empresas de tecnología deberán continuar invirtiendo en investigación y desarrollo, establecer alianzas estratégicas y mantenerse a la vanguardia de la innovación. En resumen, el crecimiento acelerado de las pequeñas empresas de tecnología en el sector de servicios demuestra cómo los principios de la microeconomía, como la adaptabilidad, la satisfacción del cliente y la eficiencia, pueden impulsar el éxito empresarial. Estas empresas están desafiando el statu quo y abriendo nuevas oportunidades económicas en el mercado actualmente competitivo.',
	'Forbes','Macroeconomía','../Imagenes/noticia4.png');
INSERT INTO Noticias (Fecha,Titulo,Texto,Fuente,Categoria,Foto) VALUES
	('18 de enero de 2023','Inflación en aumento','En un movimiento inesperado, el precio del oro experimentó un notable aumento del 5% en los mercados internacionales esta semana. Esta sorpresiva alza ha captado la atención de inversores y analistas, quienes buscan entender los factores detrás de este incremento en el valor del preciado metal. El oro, considerado tradicionalmente como un refugio seguro en tiempos de incertidumbre económica, ha encontrado un nuevo impulso en medio de crecientes preocupaciones globales. La persistente volatilidad de los mercados financieros, las tensiones comerciales entre potencias mundiales y la incertidumbre en torno a la recuperación económica post-pandemia son algunos de los elementos que han impulsado a los inversionistas a buscar refugio en activos más seguros. El metal dorado alcanzó su nivel más alto en los últimos meses, superando la barrera de los $1,800 por onza. Este repunte en su valor ha llamado la atención de inversores institucionales y minoristas por igual, quienes buscan proteger sus carteras de posibles riesgos y aprovechar las oportunidades que ofrece el mercado del oro. Expertos financieros han señalado que la reciente depreciación del dólar estadounidense también ha contribuido al alza del oro. A medida que la moneda norteamericana se debilita, el oro se vuelve más atractivo para los inversores, ya que su precio se cotiza en dólares. Esto ha impulsado la demanda de oro en los mercados internacionales y ha influido en su notable incremento. Si bien el aumento del 5% en el precio del oro ha generado expectativas entre los inversores, algunos analistas advierten que esta tendencia podría no ser sostenible a largo plazo. La evolución de la situación económica global, la respuesta de los bancos centrales y las políticas monetarias de los principales países serán factores clave que determinarán la dirección futura del mercado del oro. En conclusión, el oro ha experimentado un sorprendente incremento del 5%, impulsado por la incertidumbre económica global y el debilitamiento del dólar estadounidense. Este aumento ha generado un renovado interés por parte de los inversores en este metal precioso, aunque la sostenibilidad de esta tendencia dependerá de diversos factores económicos y políticos. Los mercados financieros permanecerán atentos a los acontecimientos futuros en busca de señales sobre la dirección del precio del oro y su impacto en la economía mundial.',
	'Financial Times','Finanzas','../Imagenes/noticia6.png');
INSERT INTO Noticias (Fecha,Titulo,Texto,Fuente,Categoria,Foto) VALUES
	('24 de mayo de 2023','Ethereum 2.0: La actualización','En los últimos meses, el Ethereum ha protagonizado un impresionante rally alcista, superando todas las expectativas y alcanzando un nuevo récord histórico. La criptomoneda más famosa del mundo ha conquistado los mercados financieros con su valor ascendente y ha despertado un renovado interés por parte de inversores y entusiastas. En la jornada de hoy, el Bitcoin alcanzó un hito significativo al superar la marca de los $80,000 por unidad. Este logro ha generado un sentimiento de euforia entre los inversionistas, quienes ven en esta criptomoneda una oportunidad de inversión rentable y de alta volatilidad. La creciente adopción del Bitcoin ha sido un factor clave en su desempeño. Cada vez más empresas, tanto pequeñas como grandes, han comenzado a aceptar Bitcoin como forma de pago, lo que ha aumentado su utilidad y legitimidad en el mundo real. Además, varios gigantes financieros han anunciado su entrada al mercado de criptomonedas, brindando mayor confianza y respaldo a esta forma de activo digital. Otro factor que impulsa el alza del Bitcoin es la demanda creciente por parte de inversores institucionales. Fondos de inversión, empresas y gestoras de activos están destinando una parte de sus carteras a esta criptomoneda, reconociendo su potencial como un activo de reserva de valor y cobertura contra la inflación. A pesar de su éxito, el Bitcoin sigue siendo objeto de debate y controversia. Los críticos señalan su volatilidad como un riesgo significativo y cuestionan su estatus como moneda real. Sin embargo, los defensores del Bitcoin argumentan que su tecnología subyacente, la cadena de bloques o blockchain, proporciona una forma segura y descentralizada de realizar transacciones, sin necesidad de intermediarios. A medida que el Bitcoin continúa su ascenso meteórico, los analistas e inversores se preguntan cuál será su próximo hito y si se mantendrá como una inversión rentable a largo plazo. La incertidumbre sigue rodeando al mercado de criptomonedas, pero la emoción y el interés en el Bitcoin no disminuyen. Los ojos de todo el mundo financiero están puestos en esta criptomoneda, esperando ver qué depara el futuro para el rey indiscutible del mundo cripto.',
	'El Economista','Criptomonedas','../Imagenes/noticia8.png');
INSERT INTO Noticias (Fecha,Titulo,Texto,Fuente,Categoria,Foto) VALUES
	('14 de junio de 2023','Ripple revoluciona el mundo','En los últimos meses, el Ripple ha protagonizado un impresionante rally alcista, superando todas las expectativas y alcanzando un nuevo récord histórico. La criptomoneda más famosa del mundo ha conquistado los mercados financieros con su valor ascendente y ha despertado un renovado interés por parte de inversores y entusiastas. En la jornada de hoy, el Bitcoin alcanzó un hito significativo al superar la marca de los $80,000 por unidad. Este logro ha generado un sentimiento de euforia entre los inversionistas, quienes ven en esta criptomoneda una oportunidad de inversión rentable y de alta volatilidad. La creciente adopción del Bitcoin ha sido un factor clave en su desempeño. Cada vez más empresas, tanto pequeñas como grandes, han comenzado a aceptar Bitcoin como forma de pago, lo que ha aumentado su utilidad y legitimidad en el mundo real. Además, varios gigantes financieros han anunciado su entrada al mercado de criptomonedas, brindando mayor confianza y respaldo a esta forma de activo digital. Otro factor que impulsa el alza del Bitcoin es la demanda creciente por parte de inversores institucionales. Fondos de inversión, empresas y gestoras de activos están destinando una parte de sus carteras a esta criptomoneda, reconociendo su potencial como un activo de reserva de valor y cobertura contra la inflación. A pesar de su éxito, el Bitcoin sigue siendo objeto de debate y controversia. Los críticos señalan su volatilidad como un riesgo significativo y cuestionan su estatus como moneda real. Sin embargo, los defensores del Bitcoin argumentan que su tecnología subyacente, la cadena de bloques o blockchain, proporciona una forma segura y descentralizada de realizar transacciones, sin necesidad de intermediarios. A medida que el Bitcoin continúa su ascenso meteórico, los analistas e inversores se preguntan cuál será su próximo hito y si se mantendrá como una inversión rentable a largo plazo. La incertidumbre sigue rodeando al mercado de criptomonedas, pero la emoción y el interés en el Bitcoin no disminuyen. Los ojos de todo el mundo financiero están puestos en esta criptomoneda, esperando ver qué depara el futuro para el rey indiscutible del mundo cripto.',
	'Forbes','Criptomonedas','../Imagenes/noticia9.png');


INSERT INTO Entradas (Fecha, Texto, IdForo, IdCliente) VALUES 
	('12/12/2022', 'Buenas a todos', '1','2');
INSERT INTO Entradas (Fecha, Texto, IdForo, IdCliente) VALUES 
	('12/12/2022', 'Buenas ', '1','1');
INSERT INTO Entradas (Fecha, Texto, IdForo, IdCliente) VALUES 
	('12/12/2022', 'Buenas', '1','2');
INSERT INTO Entradas (Fecha, Texto, IdForo, IdCliente) VALUES 
	('12/12/2022', 'Buen', '1','3');
INSERT INTO Entradas (Fecha, Texto, IdForo, IdCliente) VALUES 
	('12/12/2022', 'Buenas', '1','4');
INSERT INTO Entradas (Fecha, Texto, IdForo, IdCliente) VALUES 
	('12/12/2022', 'Buenas ', '1','2');
INSERT INTO Entradas (Fecha, Texto, IdForo, IdCliente) VALUES 
	('12/12/2022', 'Buenos días', '1','1');
INSERT INTO Entradas (Fecha, Texto, IdForo, IdCliente) VALUES 
	('12/12/2022', 'Hola', '1','2');

