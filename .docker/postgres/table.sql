CREATE TABLE Customer (
    id SERIAL PRIMARY KEY,
    name varchar(50),
    phone TEXT,
    address varchar(100),
    email varchar(100),
    pass varchar(100)
);

CREATE TABLE products(  
    id int NOT NULL PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    name VARCHAR(255),
    price INT,
    description VARCHAR(255)
);

INSERT INTO
    Customer (
        name,
        phone,
        address,
        email,
        pass
    )
VALUES (
        'Mai Huong',
        '0912341212',
        'Da Nang City',
        'Huong.@gmail.com',
        '$2y$12$ZP/ZWAQqgO2riNcKsuF9VueAqKoXquVoRiVreng2Ch888l1IpW.aS'
    ),
    (
        'Thu Trang',
        '0912341212',
        'Nha Trang City',
        'Trang.@gmail.com',
        '$2y$12$ZP/ZWAQqgO2riNcKsuF9VueAqKoXquVoRiVreng2Ch888l1IpW.aS'
    );

INSERT INTO
    products (
        name,
        price,
        description
    )
VALUES (
        'CoCa',
         8000,
        'CoCa Zero'
    ),
    (
        'Player',
         9000,
        'Player Cooling'
    ),
    (
        'HyPer',
         8000,
        'CoCa Zero'
    ),
    (
        'Vaseline',
         9000,
        'Player Cooling'
    );