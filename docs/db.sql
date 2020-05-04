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

-- add view
CREATE VIEW vPosResults
AS
Select
  COUNT(Covid19ScanResults.id) As PosSimptoms
From
  Covid19ScanResults
Where
  (Covid19ScanResults.HistoryOfFever = 1) or
  (Covid19ScanResults.TemperatureRange = 1) Or
  (Covid19ScanResults.SoreThroat = 1) Or
  (Covid19ScanResults.Cough = 1) Or
  (Covid19ScanResults.DifficultyInBreathing = 1) Or
  (Covid19ScanResults.Diarrhea = 1)
Limit 0, 1000