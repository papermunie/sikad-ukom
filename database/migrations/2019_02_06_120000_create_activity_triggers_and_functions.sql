-- Trigger untuk tabel pemasukan
CREATE TRIGGER pemasukan_kas_after_insert
AFTER INSERT ON pemasukan_kas
FOR EACH ROW
BEGIN
    CALL log_activity('Pemasukan Kas', NEW.kode_pemasukan, 'inserted');
END;

CREATE TRIGGER pemasukan_kas_after_update
AFTER UPDATE ON pemasukan_kas
FOR EACH ROW
BEGIN
    CALL log_activity('Pemasukan Kas', NEW.kode_pemasukan, 'updated');
END;

CREATE TRIGGER pemasukan_kas_after_delete
AFTER DELETE ON pemasukan_kas
FOR EACH ROW
BEGIN
    CALL log_activity('Pemasukan Kas', OLD.kode_pemasukan, 'deleted');
END;

-- Trigger untuk tabel pengeluaran
CREATE TRIGGER pengeluaran_kas_after_insert
AFTER INSERT ON pengeluaran_kas
FOR EACH ROW
BEGIN
    CALL log_activity('Pengeluaran', NEW.id, 'inserted');
END;

CREATE TRIGGER pengeluaran_kas_after_update
AFTER UPDATE ON pengeluaran_kas
FOR EACH ROW
BEGIN
    CALL log_activity('Pengeluaran', NEW.id, 'updated');
END;

CREATE TRIGGER pengeluaran_kas_after_delete
AFTER DELETE ON pengeluaran_kas
FOR EACH ROW
BEGIN
    CALL log_activity('Pengeluaran', OLD.id, 'deleted');
END;

-- Stored function untuk log aktivitas
DELIMITER $$
CREATE FUNCTION log_activity(entity VARCHAR(255), entity_id INT, action VARCHAR(255))
RETURNS INT
BEGIN
    INSERT INTO activity_logs (entity, entity_id, action, created_at) 
    VALUES (entity, entity_id, action, NOW());
    RETURN LAST_INSERT_ID();
END$$
DELIMITER ;

-- Stored procedure untuk log aktivitas
DELIMITER $$
CREATE PROCEDURE record_activity(IN entity VARCHAR(255), IN entity_id INT, IN action VARCHAR(255))
BEGIN
    INSERT INTO activity_logs (entity, entity_id, action, created_at) 
    VALUES (entity, entity_id, action, NOW());
END$$
DELIMITER ;
