CREATE TRIGGER insert_into_waitlist
	AFTER INSERT ON patientinfo
	FOR EACH ROW 
BEGIN 
	DECLARE patientUser VARCHAR(20); 
	DECLARE blood_type VARCHAR(10); 
	DECLARE ageOfPatient INT DEFAULT 15; 
	DECLARE score INT DEFAULT 0; 

	SET ageOfPatient = YEAR(DATE(NOW()) - YEAR(NEW.dob));
    SET patientUser = NEW.userID; 
	SET blood_type = NEW.bloodType; 
	SET score = 0; 
	
	IF NEW.patientType = 2
	THEN
		IF NEW.liverFlag = 1
		THEN 
		SET score = score + 50; 
		
		ELSEIF NEW.lungFlag = 1
		THEN 
		SET score = score + 40;
		
		ELSEIF NEW.kidneyFlag = 1
		THEN
		SET score = score + 30; 
		
		ELSE 
		SET score = score + 20; 
	END IF;
	
	IF NEW.patientType = 2
		THEN 
		IF blood_type = 'O+'
		THEN 
			SET score = score + 50; 
		
		ELSEIF blood_type = 'A+'
		THEN 
			SET score = score + 45; 
		
		ELSEIF blood_type = 'B+'
		THEN 
			SET score = score + 40; 
	
		ELSEIF blood_type = 'O-'
		THEN 
			SET score = score + 35; 
		
		ELSEIF blood_type = 'AB+'
		THEN 
			SET score = score + 40; 
		
		ELSEIF blood_type = 'B-'
		THEN 
			SET score = score + 35; 
		
		ELSE
			SET score = score + 30; 
		END IF;
		
        IF ageOfPatient >= 15 AND ageOfPatient < 30
        THEN 
            SET score = score + 50; 

        ELSEIF ageOfPatient >= 30 AND ageOfPatient < 45
        THEN 
            SET score = score + 40; 

        ELSEIF ageOfPatient >= 45 AND ageOfPatient < 60
        THEN 
            SET score = score + 30; 

        ELSE  
            SET score = score + 20; 
        END IF;  
		INSERT INTO waitlist VALUES (patientUser, score);
	END IF;
	END IF; 
END;