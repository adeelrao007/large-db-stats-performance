SET FOREIGN_KEY_CHECKS=0;
SET SESSION sql_mode = '';

/* =========================
   STATIC LOOKUPS
========================= */

TRUNCATE languages;
TRUNCATE currencies;
TRUNCATE regions;
TRUNCATE permissions;
TRUNCATE accounts;
TRUNCATE categories;
TRUNCATE products;
TRUNCATE product_inventory;
TRUNCATE product_prices;
TRUNCATE carts;
TRUNCATE orders;
TRUNCATE order_items;
TRUNCATE payments;
TRUNCATE conversations;
TRUNCATE conversation_participants;
TRUNCATE message_reads;
TRUNCATE activity_logs;
TRUNCATE admin_audit_logs;

INSERT INTO languages (code, name) VALUES
('en', 'English'),
('fr', 'French'),
('de', 'German'),
('ar', 'Arabic'),
('ur', 'Urdu');

INSERT INTO currencies (code, symbol, exchange_rate, is_base) VALUES
('USD', '$', 1.00000000, 1),
('EUR', '€', 0.92000000, 0),
('GBP', '£', 0.79000000, 0),
('PKR', '₨', 278.00000000, 0),
('SAR', '﷼', 3.75000000, 0);

INSERT INTO regions (code, name, default_currency_id) VALUES
('US', 'United States', 1),
('EU', 'Europe', 2),
('UK', 'United Kingdom', 3),
('PK', 'Pakistan', 4),
('KSA', 'Saudi Arabia', 5);

/* =========================
   ACCOUNTS
========================= */

INSERT INTO accounts (name)
SELECT CONCAT('Store ', n)
FROM seq_numbers
WHERE n <= 10000;

/* =========================
   CATEGORIES
========================= */

INSERT INTO categories (parent_id)
SELECT NULL FROM seq_numbers WHERE n <= 5000;

/* =========================
   PRODUCTS
========================= */

INSERT INTO products (account_id, category_id, status)
SELECT
  FLOOR(1 + RAND()*10000),
  FLOOR(1 + RAND()*5000),
  'active'
FROM seq_numbers
WHERE n <= 500000;

/* =========================
   PRODUCT INVENTORY
========================= */

INSERT INTO product_inventory (product_id, quantity)
SELECT id, FLOOR(RAND()*100)
FROM products;

/* =========================
   PRODUCT PRICES
========================= */

INSERT INTO product_prices (product_id, currency_id, price)
SELECT
  p.id,
  c.id,
  ROUND(RAND()*500,2)
FROM products p
JOIN currencies c;

/* =========================
   CARTS
========================= */

INSERT INTO carts (user_id, status)
SELECT
  FLOOR(1 + RAND()*200000),
  'active'
FROM seq_numbers
WHERE n <= 300000;

/* =========================
   ORDERS
========================= */

INSERT INTO orders (user_id, currency_id, exchange_rate, amount, status)
SELECT
  FLOOR(1 + RAND()*200000),
  1,
  1.0,
  ROUND(RAND()*1000,2),
  ELT(FLOOR(1 + RAND()*3),'pending','paid','cancelled')
FROM seq_numbers
WHERE n <= 1000000;

/* =========================
   ORDER ITEMS
========================= */

INSERT INTO order_items (order_id, product_id, quantity, price)
SELECT
  FLOOR(1 + RAND()*1000000),
  FLOOR(1 + RAND()*500000),
  FLOOR(1 + RAND()*5),
  ROUND(RAND()*300,2)
FROM seq_numbers
WHERE n <= 3000000;

/* =========================
   PAYMENTS
========================= */

INSERT INTO payments (order_id, currency_id, amount, provider)
SELECT
  id,
  currency_id,
  amount,
  'stripe'
FROM orders
WHERE status = 'paid';

/* =========================
   CONVERSATIONS
========================= */

INSERT INTO conversations (type)
SELECT ELT(FLOOR(1 + RAND()*2),'direct','group')
FROM seq_numbers
WHERE n <= 300000;

/* =========================
   CONVERSATION PARTICIPANTS
========================= */

INSERT INTO conversation_participants (conversation_id, user_id)
SELECT
  FLOOR(1 + RAND()*300000),
  FLOOR(1 + RAND()*200000)
FROM seq_numbers
WHERE n <= 1200000;

/* =========================
   MESSAGE READS
========================= */

INSERT INTO message_reads (message_id, user_id)
SELECT
  FLOOR(1 + RAND()*10000000),
  FLOOR(1 + RAND()*200000)
FROM seq_numbers
WHERE n <= 25000000;

/* =========================
   ACTIVITY LOGS
========================= */

INSERT INTO activity_logs (user_id, action, ip_address)
SELECT
  FLOOR(1 + RAND()*200000),
  ELT(FLOOR(1 + RAND()*4),'login','logout','view','purchase'),
  CONCAT(FLOOR(RAND()*255),'.',FLOOR(RAND()*255),'.',FLOOR(RAND()*255),'.',FLOOR(RAND()*255))
FROM seq_numbers
WHERE n <= 5000000;

/* =========================
   ADMIN AUDIT LOGS
========================= */

INSERT INTO admin_audit_logs (admin_user_id, action, target_type, target_id)
SELECT
  FLOOR(1 + RAND()*10000),
  'update',
  'order',
  FLOOR(1 + RAND()*1000000)
FROM seq_numbers
WHERE n <= 3000000;

SET FOREIGN_KEY_CHECKS=1;
