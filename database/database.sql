-- ===========================
-- TABLE: Service
-- ===========================
CREATE TABLE Service (
    service_id SERIAL PRIMARY KEY,
    service_name VARCHAR(200) NOT NULL,
    service_description TEXT,
    service_price FLOAT
);

-- ===========================
-- TABLE: Room
-- ===========================
CREATE TABLE Room (
    room_id SERIAL PRIMARY KEY,
    room_type VARCHAR(200) NOT NULL,
    bed_type VARCHAR(200) NOT NULL,
    price_per_night FLOAT NOT NULL,
    availabilty_status INTEGER NOT NULL,
    max_occupation INTEGER NOT NULL
);

-- ===========================
-- TABLE: AppCustomuser
-- (Equivalent of CustomUser / AbstractUser subclass)
-- ===========================
CREATE TABLE app_customuser (
    id BIGSERIAL PRIMARY KEY,
    password VARCHAR(128) NOT NULL,
    last_login TIMESTAMP NULL,
    is_superuser BOOLEAN NOT NULL DEFAULT FALSE,
    username VARCHAR(150) UNIQUE NOT NULL,
    first_name VARCHAR(150),
    last_name VARCHAR(150),
    is_staff BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    date_joined TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(254) UNIQUE NOT NULL,
    contact VARCHAR(15),
    gender TEXT,
    salary FLOAT,
    role VARCHAR(200),
    id_no INTEGER UNIQUE NOT NULL,
    service_id INTEGER REFERENCES Service(service_id)
        ON DELETE SET NULL ON UPDATE CASCADE
);

-- ===========================
-- TABLE: Booking
-- ===========================
CREATE TABLE Booking (
    booking_id SERIAL PRIMARY KEY,
    user_id BIGINT REFERENCES app_customuser(id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    room_id INTEGER REFERENCES Room(room_id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    check_in_date TEXT,
    check_out_date DATE,
    number_of_guests INTEGER,
    total_price FLOAT,
    booking_status TEXT DEFAULT 'active'
);

-- ===========================
-- TABLE: Inventory
-- ===========================
CREATE TABLE Inventory (
    inventory_id SERIAL PRIMARY KEY,
    item_name VARCHAR(200),
    category VARCHAR(200),
    service_time TEXT,
    item_description TEXT,
    quantity INTEGER,
    price_per_unit FLOAT
);

-- ===========================
-- TABLE: Service_request
-- ===========================
CREATE TABLE Service_request (
    request_id SERIAL PRIMARY KEY,
    user_id BIGINT REFERENCES app_customuser(id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    booking_id INTEGER REFERENCES Booking(booking_id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    service_id INTEGER REFERENCES Service(service_id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    request_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    request_status TEXT DEFAULT 'pending'
);

-- ===========================
-- TABLE: Payment
-- ===========================
CREATE TABLE Payment (
    payment_id SERIAL PRIMARY KEY,
    user_id BIGINT REFERENCES app_customuser(id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    booking_id INTEGER REFERENCES Booking(booking_id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    service_id INTEGER REFERENCES Service(service_id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    amount FLOAT,
    payment_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    payment_mode TEXT NOT NULL,
    account INTEGER,
    payment_status TEXT DEFAULT 'paid'
);
