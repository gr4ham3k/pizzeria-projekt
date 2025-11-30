CREATE OR REPLACE FUNCTION delete_cart_item(p_id_koszyka INT)
RETURNS VOID AS $$
BEGIN
    DELETE FROM koszyk
    WHERE id_koszyka = p_id_koszyka;
END;
$$ LANGUAGE plpgsql;
