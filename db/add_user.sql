CREATE OR REPLACE FUNCTION add_user(p_email TEXT, p_password TEXT)
RETURNS VOID
AS $$
BEGIN
    INSERT INTO uzytkownicy (email, haslo, rola)
    VALUES (p_email, p_password, 'uzytkownik');
END;
$$ LANGUAGE plpgsql;
