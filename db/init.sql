-- Medy's Catering – PostgreSQL schema
-- Auto-applied on first boot of the Postgres container (docker-entrypoint-initdb.d).
-- For Render, run this once against the managed database (psql $DATABASE_URL -f db/init.sql).

CREATE TABLE IF NOT EXISTS bookings (
    id               SERIAL PRIMARY KEY,
    client_id        VARCHAR(32)  NOT NULL UNIQUE,
    client_name      VARCHAR(120) NOT NULL,
    email            VARCHAR(160),
    phone            VARCHAR(40),
    alt_phone        VARCHAR(40),
    event_type       VARCHAR(60)  NOT NULL,
    event_date       DATE         NOT NULL,
    event_time       TIME,
    guest_count      INTEGER      NOT NULL DEFAULT 0,
    package          VARCHAR(60)  NOT NULL,
    venue            VARCHAR(255) NOT NULL,
    duration         VARCHAR(60),
    decoration       VARCHAR(20)  DEFAULT 'no',
    theme            VARCHAR(120),
    special_requests TEXT,
    referral         VARCHAR(120),
    status           VARCHAR(20)  NOT NULL DEFAULT 'pending'
                     CHECK (status IN ('pending','confirmed','completed','cancelled')),
    created_at       TIMESTAMPTZ  NOT NULL DEFAULT NOW()
);
CREATE INDEX IF NOT EXISTS idx_bookings_event_date ON bookings (event_date);
CREATE INDEX IF NOT EXISTS idx_bookings_status     ON bookings (status);

CREATE TABLE IF NOT EXISTS users (
    id          SERIAL PRIMARY KEY,
    full_name   VARCHAR(120) NOT NULL,
    username    VARCHAR(60)  NOT NULL UNIQUE,
    email       VARCHAR(160),
    password    VARCHAR(255) NOT NULL,
    role        VARCHAR(10)  NOT NULL DEFAULT 'staff'
                CHECK (role IN ('admin','staff')),
    status      VARCHAR(10)  NOT NULL DEFAULT 'active'
                CHECK (status IN ('active','inactive')),
    created_at  TIMESTAMPTZ  NOT NULL DEFAULT NOW()
);

CREATE TABLE IF NOT EXISTS feedback (
    id              SERIAL PRIMARY KEY,
    client_name     VARCHAR(120) NOT NULL,
    email           VARCHAR(160),
    event_type      VARCHAR(60),
    has_booked      VARCHAR(5)   DEFAULT 'yes'
                    CHECK (has_booked IN ('yes','no')),
    star_rating     SMALLINT     NOT NULL CHECK (star_rating BETWEEN 1 AND 5),
    comments        TEXT         NOT NULL,
    liked_tags      TEXT,
    date_submitted  DATE         NOT NULL DEFAULT CURRENT_DATE,
    status          VARCHAR(10)  NOT NULL DEFAULT 'new'
                    CHECK (status IN ('new','read')),
    created_at      TIMESTAMPTZ  NOT NULL DEFAULT NOW()
);
CREATE INDEX IF NOT EXISTS idx_feedback_created_at ON feedback (created_at DESC);

CREATE TABLE IF NOT EXISTS contact_messages (
    id          SERIAL PRIMARY KEY,
    full_name   VARCHAR(120) NOT NULL,
    email       VARCHAR(160) NOT NULL,
    phone       VARCHAR(40),
    subject     VARCHAR(160) NOT NULL,
    message     TEXT         NOT NULL,
    created_at  TIMESTAMPTZ  NOT NULL DEFAULT NOW()
);

-- Seed an initial admin so /medysStaff/login.php is usable on first boot.
-- Username: admin   Password: admin123   (change immediately in production)
-- Hash generated with: php -r "echo password_hash('admin123', PASSWORD_BCRYPT);"
INSERT INTO users (full_name, username, email, password, role, status)
VALUES (
    'Administrator',
    'admin',
    'admin@medyscatering.local',
    '$2y$10$iLlO2..oGE4OlPa1Hi7wJOTboefzmUq6FrkXvrAdp8idvmnneuK.e',
    'admin',
    'active'
)
ON CONFLICT (username) DO NOTHING;
