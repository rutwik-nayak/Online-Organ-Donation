CREATE TRIGGER update_status
	AFTER INSERT ON organs
	FOR EACH ROW 
BEGIN
	DECLARE recipientUser VARCHAR(20); 
	DECLARE donorUser VARCHAR(20); 
	SET recipientUser = NEW.userID; 
	SET donorUser = NEW.donorID; 
	
	UPDATE patientinfo 
	SET available = 2 
	WHERE recipientUser = userID OR donorUser = userID; 
END;