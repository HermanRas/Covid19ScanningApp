--#SQLite sondagskooldb
/**
--Command	Description
.show	Displays current settings for various parameters
.databases	Provides database names and files
.quit	Quit sqlite3 program
.tables	Show current tables
.schema	Display schema of table
.header	Display or hide the output table header
.mode Select mode for the output table
.dump	Dump database in SQL text format

--cleanup
DELETE FROM tblename;
VACUUM;
**/

--create new tables
CREATE TABLE Covid19ScanResults ( 
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	IDNumber TEXT NOT NULL,
	Temperature INTEGER,
	DateTimeStamp dDATETIME DEFAULT CURRENT_TIMESTAMP,
	TemperatureRange BIT NOT NULL,
	HistoryOfFever BIT NOT NULL,
	SoreThroat BIT NOT NULL,
	Cough BIT NOT NULL,
	DifficultyInBreathing BIT NOT NULL,
    Diarrhea BIT NOT NULL);

