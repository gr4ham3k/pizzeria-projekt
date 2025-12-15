CREATE TRIGGER trigger_limit_koszyka
BEFORE INSERT ON koszyk
FOR EACH ROW
EXECUTE FUNCTION limit_koszyka();

