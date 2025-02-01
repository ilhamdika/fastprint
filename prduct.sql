
CREATE TABLE IF NOT EXISTS kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS status (
    id_status INT AUTO_INCREMENT PRIMARY KEY,
    nama_status VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS produk (
    id_produk INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(255) NOT NULL,
    harga DECIMAL(10, 2) NOT NULL,
    kategori_id INT NOT NULL,
    status_id INT NOT NULL,
    FOREIGN KEY (kategori_id) REFERENCES Kategori(id_kategori) ON DELETE CASCADE,
    FOREIGN KEY (status_id) REFERENCES Status(id_status) ON DELETE CASCADE
);
