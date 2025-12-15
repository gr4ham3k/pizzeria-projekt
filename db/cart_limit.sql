CREATE OR REPLACE FUNCTION limit_koszyka()
RETURNS TRIGGER AS $$
DECLARE
    liczba_rekordow integer;
BEGIN
    SELECT COUNT(*) INTO liczba_rekordow
    FROM koszyk
    WHERE id_uzytkownika = NEW.id_uzytkownika;

    IF liczba_rekordow >= 10 THEN
        RAISE EXCEPTION 'Nie możesz mieć więcej niż 10 pozycji w koszyku';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

