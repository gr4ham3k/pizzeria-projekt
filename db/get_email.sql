CREATE OR REPLACE FUNCTION get_user_by_email(p_email VARCHAR)
RETURNS TABLE (
    id_uzytkownika INTEGER,
    email VARCHAR,
    rola VARCHAR,
    haslo VARCHAR
)
AS $$
BEGIN
    RETURN QUERY
    SELECT u.id_uzytkownika,u.email,u.rola,u.haslo
    FROM uzytkownicy as u
    WHERE u.email = p_email;
END;
$$ LANGUAGE plpgsql;

