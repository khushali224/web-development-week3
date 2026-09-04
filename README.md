# Rasit Watch PHP/MySQL E-Commerce
1. Extract `rasit_watch` to `C:\xampp\htdocs\rasit_watch`.
2. Start Apache and MySQL.
3. Open phpMyAdmin and import `database/rasit_watch_db.sql`.
4. Open http://localhost/rasit_watch/
5. Admin: http://localhost/rasit_watch/admin/
Email: admin@gmail.com
Password: admin
Features: Home, About, Products, Search, Product Details, Cart, quantity update, Wishlist, Register/Login, Checkout, order storage, confirmation, Admin dashboard, Add Product and Order list.


## Admin Panel
Open `http://localhost/Rasit_Watch_Complete/admin/` to get the separate Admin Login.
- Email: `admin@gmail.com`
- Password: `admin123`

Admin features: Dashboard, Products (add/edit/delete), Orders and status updates, Users, Cart data, Wishlist data, Reviews, and Logout.

**Important:** Import `database/rasit_watch_db.sql` again in phpMyAdmin if you are upgrading from an older database, because the SQL creates the new `cart_items`, `wishlist_items`, and `reviews` tables and updates the admin password.
