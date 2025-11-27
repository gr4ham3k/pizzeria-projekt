CREATE OR REPLACE FUNCTION login(
    p_email VARCHAR,
    p_haslo VARCHAR
)
RETURNS TABLE (
    id_uzytkownika INT,
    email VARCHAR,
    haslo VARCHAR,
    rola VARCHAR
)
AS $$
BEGIN
    RETURN QUERY
    SELECT u.id_uzytkownika, u.email, u.haslo, u.rola
    FROM uzytkownicy u
    WHERE u.email = p_email
      AND u.haslo = p_haslo;
END;
$$ LANGUAGE plpgsql;
