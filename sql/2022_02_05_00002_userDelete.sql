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
CREATE PROCEDURE userDelete
	(
		@id		BIGINT,
		@idDelete	BIGINT
	)
AS
BEGIN
	SET NOCOUNT ON;
	
	UPDATE [dbo].[users]
	   SET [idDelete] = @idUpdate
		  ,[deleted_at] = GETDATE()
	 WHERE id=@id;

	SET NOCOUNT OFF;

END
GO