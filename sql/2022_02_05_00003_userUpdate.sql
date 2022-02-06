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
CREATE PROCEDURE userUpdate
	(
		@id			BIGINT,
		@user		NVARCHAR(255),
		@email		NVARCHAR(255),
		@telefono	NVARCHAR(255),
		@password	NVARCHAR(255),
		@idrol		NVARCHAR(255),
		@idUpdate	BIGINT,
		@idclient	NVARCHAR(15) NULL
	)
AS
BEGIN
	SET NOCOUNT ON;

	UPDATE [dbo].[users]
	   SET [idclient] = @idclient
		  ,[idUpdate] = @idUpdate
		  ,[user] = @user
		  ,[email] = @email
		  ,[telefono] = @telefono
		  ,[password] = @password
		  ,[idrol] = @idrol
		  ,[updated_at] = GETDATE()
	 WHERE id=@id;

	 IF @idclient<>''
	 BEGIN
		 UPDATE [dbo].[users]
		   SET [idclient] = @idclient
		 WHERE id=@id;
	 END 

	 IF @password<>''
	 BEGIN
		 UPDATE [dbo].[users]
		   SET [password] = @password
		 WHERE id=@id;
	 END

	SET NOCOUNT OFF;

END
GO