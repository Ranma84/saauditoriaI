-- ================================================
-- Insertar usuario de SQL Server
-- ================================================
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE userInsert 
	(
		@user		NVARCHAR(255),
		@email		NVARCHAR(255),
		@telefono	NVARCHAR(255),
		@password	NVARCHAR(255),
		@idrol		NVARCHAR(255),
		@idCreador	BIGINT,
		@idclient	NVARCHAR(15) NULL
	)
AS
BEGIN
	SET NOCOUNT ON;

    INSERT INTO [dbo].[users]
           ([idclient]
           ,[idCreador]
           ,[user]
           ,[email]
           ,[telefono]
           ,[password]
           ,[estado]
           ,[idrol]
           ,[created_at])
     VALUES
           (@idclient
           ,@idCreador
           ,@user
           ,@email
           ,@telefono
           ,@password
           ,1
           ,@idrol
           ,GETDATE());

	SET NOCOUNT OFF;

END
GO
