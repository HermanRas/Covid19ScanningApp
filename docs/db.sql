/****** Object:  Table [dbo].[Covid19ScanResults]    Script Date: 2020/04/27 11:39:38 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Covid19ScanResults](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[DateTimeStamp] [smalldatetime] NOT NULL,
	[CompanyNumber] [nvarchar](50) NOT NULL,
	[Temperature] [nvarchar](50) NOT NULL,
	[TemperatureRange] [smallint] NOT NULL,
	[HistoryOfFever] [smallint] NOT NULL,
	[SoreThroat] [smallint] NOT NULL,
	[Cough] [smallint] NOT NULL,
	[DifficultyInBreathing] [smallint] NOT NULL,
	[Diarrhea] [smallint] NOT NULL
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[Covid19ScanResults] ADD  CONSTRAINT [DF_Covid19ScanResults_DateTimeStamp]  DEFAULT (getdate()) FOR [DateTimeStamp]
GO