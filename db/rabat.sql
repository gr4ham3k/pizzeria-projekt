CREATE OR REPLACE FUNCTION rabat()
RETURNS TRIGGER AS $$
DECLARE
    pizza_count integer;
BEGIN
    SELECT SUM(ilosc)
    INTO pizza_count
    FROM zamowienie_pizze
    WHERE id_zamowienia = NEW.id_zamowienia;

    IF pizza_count >= 2 THEN
        UPDATE zamowienia
        SET rabat = 0.15
        WHERE id_zamowienia = NEW.id_zamowienia;
    ELSE
        UPDATE zamowienia
        SET rabat = 0
        WHERE id_zamowienia = NEW.id_zamowienia;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
