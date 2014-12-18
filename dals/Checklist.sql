drop database Checklist;
create database Checklist;
use Checklist;

create table tbUser(
UserID        int primary key auto_increment,
FirstName     varchar(60) not null,
LastName      varchar(60) not null,
Email         varchar(60) not null,
Password      varchar(60) not null,
SecurityLevel int not null  -- 1 is normal user and 2 is admin
);

insert into tbUser(FirstName, LastName, Email, Password, SecurityLevel) values
('Nupur','Singh','nupur@gmail.com','test', 2),
('Jeffrey','Torres','jeffrey@gmail.com','test', 2),
('Erika','Cruz','erika@gmail.com', 'test', 1),
('Shlomo','Margulets','stan@gmail.com','test', 1),
('Elvira','Estoesta','elvira@gmail.com','test', 1);

create table tbGroup(
GroupID       int primary key auto_increment,
GroupName     varchar(60) not null
);

insert into tbGroup (GroupName) values
('Accounts'),
('FrontDesk'),
('Human Resource'),
('Management'),
('Admin');

create table tbUserGroup(
UserGroupID   int primary key auto_increment,
UserID        int,
			  FOREIGN KEY (UserID) REFERENCES tbUser(UserID),
GroupID       int,
			  FOREIGN KEY (GroupID) REFERENCES tbGroup(GroupID)
);

insert into tbUserGroup (UserID, GroupID) values
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

create table tbChecklist(
ChecklistID   int primary key auto_increment,
ChecklistName varchar(60)
);

insert into tbChecklist (ChecklistName) values
('testChecklistOne'),
('testChecklistTwo'),
('testChecklistThree'),
('testChecklistFour'),
('testChecklistFive'),
('testChecklistSix');

create table tbTask(
TaskID        int primary key auto_increment,
TaskName      varchar(60),
ChecklistID   int,
              FOREIGN KEY (ChecklistID) REFERENCES tbChecklist(ChecklistID),
TaskTime      datetime
);

create table tbTaskProperties(
TaskPropertyID int,
TaskID         int,
               FOREIGN KEY (TaskID) REFERENCES tbTask(TaskID),
PropertyName   varchar(60),
PropertyValue  decimal(10,2) null   -- PropertyValue is optional so it is set to null
);

create table tbStatus(
StatusID      int primary key auto_increment,
StatusName    varchar(60)
);

insert into tbStatus (StatusName) values
('In Progress'),
('Pending'),
('Completed');

create table tbAssignChecklist(
AssignID      int primary key auto_increment,
GroupID       int,
              FOREIGN KEY (GroupID) REFERENCES tbGroup(GroupID),
ChecklistID   int,
              FOREIGN KEY (ChecklistID) REFERENCES tbChecklist(ChecklistID),
AssignTime    datetime
);
 
                -- ***************STORED PROCEDURES*************** --
-- NOTE:
-- naming convention:
-- all parameters passed to stored procedures have 'p_' prefixed to them

 DELIMITER //
 CREATE PROCEDURE spLogin(
 p_Email         varchar(20),
 p_Password      varchar(20)
 )
   BEGIN
   select * from tbUser 
   where Email    = p_Email and
		 Password = p_Password;
   END //
 DELIMITER ;
 
-- CRUD FOR tbUser --
 DELIMITER //
 CREATE PROCEDURE spInsertUser(
 p_FirstName     varchar(60),
 p_LastName      varchar(60),
 p_Email         varchar(60),
 p_Password      varchar(60)
 )
   BEGIN
   insert into tbUser 
   (FirstName, LastName, Email, Password, SecurityLevel) values
   (p_FirstName, p_LastName, p_Email, p_Password, 1);
-- security level for every new user registration will be 1 by default
-- but it can be changed by admin in update stored procedure
   END //
 DELIMITER ;
 
 DELIMITER //
 CREATE PROCEDURE spUpdateUser(
 p_UserID        int,
 p_FirstName     varchar(60),
 p_LastName      varchar(60),
 p_Email         varchar(60),
 p_Password      varchar(60),
 p_SecurityLevel int
 )
   BEGIN
   update tbUser set
   FirstName      = p_FirstName,
   LastName       = p_LastName,
   Email          = p_Email,
   Password       = p_Password,
   SecurityLevel  = p_SecurityLevel
   
   where UserID = p_UserID;
   END //
 DELIMITER ;
 
 DELIMITER //
 CREATE PROCEDURE spDeleteUser(
 p_UserID int
 )  
   BEGIN
   delete from tbUserGroup
         where UserID = p_UserID;
   delete from tbUser 
         where UserID = p_UserID;
   END //
 DELIMITER ;
   
-- CRUD for tbGroup --
 DELIMITER //
 CREATE PROCEDURE spInsertGroup(
 p_GroupName varchar(60)
 )  
   BEGIN
   insert into tbGroup (GroupName) values
					   (p_GroupName);
    END //
 DELIMITER ;
 
 DELIMITER //
 CREATE PROCEDURE spUpdateGroup(
 p_GroupID   int,
 p_GroupName varchar(60)
 )
   BEGIN
   update tbGroup set
   GroupName = p_GroupName
   where GroupID = p_GroupID;
    END //
 DELIMITER ;
 
 DELIMITER //
 CREATE PROCEDURE spDeleteGroup(
 p_GroupID int
 )  
   BEGIN
   delete from tbUserGroup
         where GroupID = p_GroupID;
   delete from tbGroup 
         where GroupID = p_GroupID;
   END //
 DELIMITER ;
 
 -- CRUD for tbUserGroup --
 -- this procedure inserts or assigns users to selected groups --
 DELIMITER //
 CREATE PROCEDURE spInsertUserGroup(
 p_UserID  varchar(60),
 p_GroupID varchar(60)
 )
   BEGIN
   insert into tbUserGroup (UserID, GroupID) values
                          (p_UserID, p_GroupID);
    END //
 DELIMITER ;
 
 -- this procedure will update or change users from one group to another
 DELIMITER //
 CREATE PROCEDURE spUpdateUserGroup(
 p_UserID  varchar(60),
 p_GroupID varchar(60)
 )
   BEGIN
     update tbUserGroup set
            GroupID = p_GroupID
     where  UserID  = p_UserID; 
    END //
 DELIMITER ;
 
 -- this procedure gets all users and their groups
 DELIMITER //
 CREATE PROCEDURE spGetUserGroup(
 )
   BEGIN
        select tbUser.UserID, FirstName, LastName, Email, SecurityLevel, 
               tbGroup.GroupID, GroupName
        from   tbUserGroup, tbUser, tbGroup
        where  tbUser.UserID = tbUserGroup.UserID and
			   tbUserGroup.GroupID = tbGroup.GroupID;
    END //
 DELIMITER ;
 
 -- CRUD for tbChecklist
 DELIMITER //
 CREATE PROCEDURE spInsertChecklist(
 p_ChecklistName varchar(60)
 )
   BEGIN
   insert into tbChecklist (ChecklistName) values
                          (p_ChecklistName);
    END //
 DELIMITER ;
 
 DELIMITER //
 CREATE PROCEDURE spUpdateChecklist(
 p_ChecklistID int,
 p_ChecklistName varchar(60)
 )
   BEGIN
   update tbChecklist set
		  ChecklistName = p_ChecklistName
   where  ChecklistID   = p_ChecklistID;
    END //
 DELIMITER ;
 
 DELIMITER //
 CREATE PROCEDURE spDeleteChecklist(
 p_ChecklistID int
 )
   BEGIN
        delete from tbAssignChecklist
			   where ChecklistID = p_ChecklistID;
		delete from tbTask
			   where ChecklistID = p_ChecklistID;
		delete from tbChecklist
			   where ChecklistID = p_ChecklistID;
    END //
 DELIMITER ;
 
 DELIMITER //
 CREATE PROCEDURE spGetChecklists(
 )
    begin
         select * from tbChecklist;		 		
  END //
 DELIMITER ;
 
 -- this procedure shows or displays all checklists with each of their specific tasks
 DELIMITER //
 CREATE PROCEDURE spGetChecklistWithTasks(
 )
    begin
         select tbChecklist.ChecklistID, ChecklistName, 
                TaskID, TaskName, TaskTime
         from   tbChecklist, tbTask
         where  tbChecklist.ChecklistID = tbTask.ChecklistID;		
  END //
 DELIMITER ;
 
 -- CRUD for tbTask
 DELIMITER //
 CREATE PROCEDURE spInsertTask(
 p_TaskName varchar(60),
 p_ChecklistID int,
 p_TaskTime datetime
 )
    begin
		 insert into tbTask (TaskName, ChecklistID, TaskTime) values
                          (p_TaskName, p_ChecklistID, p_TaskTime);
  END //
 DELIMITER ;
 
 DELIMITER //
 CREATE PROCEDURE spUpdateTask(
 p_TaskID int,
 p_TaskName varchar(60),
 p_ChecklistID int,
 p_TaskTime datetime
 )
	begin
         update tbTask set
				TaskName     = p_TaskName,
                ChecklistID  = p_ChecklistID,
                TaskTime     = p_TaskTime
		 where  TaskID       = p_TaskID;
    END //
 DELIMITER ;
 
 DELIMITER //
 CREATE PROCEDURE spDeleteTask(
 p_TaskID int
 )
    begin
		 delete from tbTask
         where  TaskID = p_TaskID;
    END //
 DELIMITER ;
 
 -- CRUD for tbStatus
 DELIMITER //
 CREATE PROCEDURE spInsertStatus(
 p_StatusName varchar(60)
 )
    begin
		 insert into tbStatus (StatusName) values
                             (p_StatusName);
    END //
 DELIMITER ;
 
  DELIMITER //
 CREATE PROCEDURE spUpdateStatus(
 p_StatusID int,
 p_StatusName varchar(60)
 )
    begin
		 update tbStatus set
				StatusName = p_StatusName
		 where  StatusID   = p_StatusID;		
    END //
 DELIMITER ;
 
 DELIMITER //
 CREATE PROCEDURE spDeleteStatus(
 p_StatusID int
 )
    begin
		 delete from tbStatus
         where StatusID = p_StatusID;
    END //
 DELIMITER ;
 
 -- CRUD for tbAssignChecklist
 -- this procedure inserts new columns in tbAssignChecklist
 DELIMITER //
 CREATE PROCEDURE spAssignChecklist(  
 p_GroupID int,
 p_ChecklistID int,
 p_AssignTime int
 )
    begin
		 insert into tbAssignChecklist 
                (GroupID, ChecklistID, AssignTime) values
			   (p_GroupID, p_ChecklistID, p_AssignTime);              
    END //
 DELIMITER ;
 
 -- this procedure updates or modifies data in tbAssignChecklist
 DELIMITER //
 CREATE PROCEDURE spUpdateAssignChecklist(
 p_AssignID int,
 p_GroupID int,
 p_ChecklistID int,
 p_AssignTime datetime
 )
    begin
         update tbAssignChecklist set
				GroupID     = p_GroupID,
                ChecklistID = p_ChecklistID,
                AssignTime  = NOW()   -- gets current date time
		 where  AssignID    = p_AssignID;		
    END //
 DELIMITER ;
 
 -- this procedure deletes assigned checklists from tbAssignChecklist
  DELIMITER //
 CREATE PROCEDURE spDeleteAssignChecklist(
 p_AssignID int
 )
    begin
		 delete from tbAssignChecklist
         where AssignID = p_AssignID;
    END //
 DELIMITER ;
 
-- Stored Procedures to enter trigger logs in Log Tables --