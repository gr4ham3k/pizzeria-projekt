CREATE OR REPLACE FUNCTION get_user_by_email(p_email VARCHAR)
RETURNS TABLE (
    email VARCHAR
)
AS $$
BEGIN
    RETURN QUERY
    SELECT u.email
    FROM uzytkownicy as u
    WHERE u.email = p_email;
END;
$$ LANGUAGE plpgsql;

