CREATE TRIGGER update_status_surgery
AFTER INSERT ON scheduler
FOR EACH ROW
BEGIN
	DECLARE recipientUser VARCHAR(20); 
	DECLARE donorUser VARCHAR(20); 
	SET recipientUser = NEW.recipientID; 

	SET donorUser = NEW.donorID; 
	
	UPDATE patientinfo 
	SET available = 3 
	WHERE recipientUser = userID OR donorUser = userID; 
END