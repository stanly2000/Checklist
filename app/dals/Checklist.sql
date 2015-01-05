drop database Checklist;
create database Checklist;
use Checklist;

create table tbUser(
UserID        int primary key auto_increment,
FirstName     varchar(60) not null,
LastName      varchar(60) not null,
Email         varchar(60) not null,
Password      varchar(128) not null,
Salt          varchar(60) not null,
SecurityLevel int not null  -- 1 is normal user and 2 is admin
);

insert into tbUser(FirstName, LastName, Email, Password, Salt, SecurityLevel) values
('Nupur','Singh','nupur@gmail.com','$6$rounds=6666$/oPdCi9Uvbrpr3iP$a2yH4L8NYO7PIuO8CmmW5ZKxF.4m2CpURZpshsS7lAGdYqBL/ezBkki1c.I6CvhYe7OL1bo5IuRYZfy6m1yjK0','/oPdCi9Uvbrpr3iP',2),
('Jeffrey','Torres','jeffrey@gmail.com','$6$rounds=6666$/oPdCi9Uvbrpr3iP$a2yH4L8NYO7PIuO8CmmW5ZKxF.4m2CpURZpshsS7lAGdYqBL/ezBkki1c.I6CvhYe7OL1bo5IuRYZfy6m1yjK0','/oPdCi9Uvbrpr3iP', 2),
('Erika','Cruz','erika@gmail.com', '$6$rounds=6666$/oPdCi9Uvbrpr3iP$a2yH4L8NYO7PIuO8CmmW5ZKxF.4m2CpURZpshsS7lAGdYqBL/ezBkki1c.I6CvhYe7OL1bo5IuRYZfy6m1yjK0', '/oPdCi9Uvbrpr3iP',1),
('Shlomo','Margulets','stan@gmail.com', '$6$rounds=6666$VMFnFSJPzOjm4NZx$9lDXIgQUoAx0FXFbFNOsIbirgbNz5kTILhDy9r6oc9xKHKhoOrpZ1HyyfX/A5vZOMUhc707Ho2JLZ0glg5xiz/','VMFnFSJPzOjm4NZx',1),
('Elvira','Estoesta','elvira@gmail.com','$6$rounds=6666$VMFnFSJPzOjm4NZx$9lDXIgQUoAx0FXFbFNOsIbirgbNz5kTILhDy9r6oc9xKHKhoOrpZ1HyyfX/A5vZOMUhc707Ho2JLZ0glg5xiz/','VMFnFSJPzOjm4NZx', 1);

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

insert into tbTask(TaskName, ChecklistID, TaskTime) values
('Shift Start',1, '2014-01-1'),
('Shift End',1, '2014-01-1');

create table tbTaskProperties(
TaskPropertyID    int primary key auto_increment,
TaskID            int,
                  FOREIGN KEY (TaskID) REFERENCES tbTask(TaskID),
PropertyName      varchar(60),
PropertyAttribute varchar(120) null, -- attribute can be optional
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

-- this table has all the assigned checklists
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
 p_Email         varchar(20)
 )
   BEGIN
   select * from tbUser 
   where Email    = p_Email;
   END //
 DELIMITER ;
 
-- CRUD FOR tbUser --
 DELIMITER //
 CREATE PROCEDURE spGetUsers(
 )
    begin
         select * from tbUser;		 		
  END //
 DELIMITER ;

-- security level for every new user registration will be 1 by default
-- but it can be changed by admin in update stored procedure
 DELIMITER //
 CREATE PROCEDURE spInsertUser(
 p_FirstName     varchar(60),
 p_LastName      varchar(60),
 p_Email         varchar(60),
 p_Password      varchar(128),
 p_Salt          varchar(60)
 )
   BEGIN
   insert into tbUser 
   (FirstName, LastName, Email, Password, Salt, SecurityLevel) values
   (p_FirstName, p_LastName, p_Email,  p_Password, p_Salt, 1);
  SET @lastID = LAST_INSERT_ID();
                          SELECT @lastID as lastInsertID;
   END //
 DELIMITER ;
 
 DELIMITER //
 CREATE PROCEDURE spUpdateUser(
 p_UserID        int,
 p_FirstName     varchar(60),
 p_LastName      varchar(60),
 p_Email         varchar(60),
 p_Password      varchar(128),
 p_Salt          varchar(60),
 p_SecurityLevel int
 )
   BEGIN
   update tbUser set
   FirstName      = p_FirstName,
   LastName       = p_LastName,
   Email          = p_Email,
   Password       = p_Password,
   Salt           = p_Salt,
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
  SET @lastID = LAST_INSERT_ID();
                          SELECT @lastID as lastInsertID;
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
  SET @lastID = LAST_INSERT_ID();
                          SELECT @lastID as lastInsertID;
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

 -- this procedure gets all users by supplied GroupID 
DELIMITER //
 CREATE PROCEDURE spGetUserGroupByID(
 p_GroupID int
 )
   BEGIN
        select tbUser.UserID, FirstName, LastName, Email, SecurityLevel, 
               tbGroup.GroupID, GroupName
        from   tbUserGroup, tbUser, tbGroup
        where  tbUser.UserID = tbUserGroup.UserID and
               tbUserGroup.GroupID = p_GroupID and
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
  SET @lastID = LAST_INSERT_ID();
                          SELECT @lastID as lastInsertID;
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
 p_ChecklistID int
 )
    begin
         select tbChecklist.ChecklistID, ChecklistName, 
                TaskID, TaskName, TaskTime
         from   tbChecklist, tbTask
         where  tbChecklist.CheclistID = p_ChecklistID and
                tbChecklist.ChecklistID = tbTask.ChecklistID;		
  END //
 DELIMITER ;
 
 -- CRUD for tbTask
 DELIMITER //
 CREATE PROCEDURE spGetTasks(
 )
    begin
         select * from tbTask;		 		
  END //
 DELIMITER ;

 DELIMITER //
 CREATE PROCEDURE spInsertTask(
 p_TaskName varchar(60),
 p_ChecklistID int,
 p_TaskTime datetime
 )
    begin
		 insert into tbTask (TaskName, ChecklistID, TaskTime) values
                          (p_TaskName, p_ChecklistID, p_TaskTime);
  SET @lastID = LAST_INSERT_ID();
                          SELECT @lastID as lastInsertID;
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

--CRUD for tbTaskProperties
 DELIMITER //
 CREATE PROCEDURE spInsertTaskProperties(
 p_TaskID int,
 p_PropertyName varchar(60),
 p_PropertyAttribute varchar(120),
 p_PropertyValue decimal(10,2)
 )
    begin
         insert into tbTaskProperties
               (TaskID, PropertyName, PropertyAttribute, PropertyValue) values
              (p_TaskID, p_PropertyName, p_PropertyAttribute, p_PropertyValue);
  SET @lastID = LAST_INSERT_ID();
                          SELECT @lastID as lastInsertID; 
END //
 DELIMITER ;
 
 DELIMITER //
 CREATE PROCEDURE spUpdateTaskProperties(
 p_TaskPropertyID int,
 p_TaskID int,
 p_PropertyName varchar(60),
 p_PropertyAttribute varchar(120),
 p_PropertyValue decimal(10,2)
)
 begin
      update tbTaskProperties set
             TaskID            = p_TaskID,
             PropertyName      = p_PropertyName,
             PropertyAttribute = p_PropertyAttribute, 
             PropertyValue     = p_PropertyValue
      where
             TaskPropertyID    = p_TaskPropertyID;
 END //
 DELIMITER ;

 DELIMITER //
 CREATE PROCEDURE spDeleteTaskProperties(
 p_TaskPropertyID int
)
 begin
      delete from tbTaskProperties
      where TaskPropertyID = p_TaskPropertyID;
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
  SET @lastID = LAST_INSERT_ID();
                          SELECT @lastID as lastInsertID;
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
  SET @lastID = LAST_INSERT_ID();
                          SELECT @lastID as lastInsertID;            
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
 
-- LOG Tables and Stored Procedures to enter trigger logs --

-- log table for tbUser 
create table log_tbUser(
LogID             int primary key auto_increment,
UserID            int unsigned not null,
old_FirstName     varchar(60) null,
new_FirstName     varchar(60) null,
old_LastName      varchar(60) null,
new_LastName      varchar(60) null,
old_Email         varchar(60) null,
new_Email         varchar(60) null,
old_Password      varchar(128) null,
new_Password      varchar(128) null,
old_Salt          varchar(60) null,
new_Salt          varchar(60) null,
old_SecurityLevel int  null ,
new_SecurityLevel int  null,
ActionType  ENUM  ('insert','update','delete') not null,
TimeStamp         timestamp not null           
);

-- stored proc to insert into log_tbUser
DELIMITER //
CREATE TRIGGER ai_tbUser 
-- after insert data for tbUser
       AFTER INSERT ON tbUser
                  FOR EACH ROW
BEGIN
       INSERT INTO log_tbUser
              (UserID, old_FirstName, new_FirstName, old_LastName,
               new_LastName, old_Email, new_Email, old_Password,
               new_Password, old_Salt, new_Salt, old_SecurityLevel,
               new_SecurityLevel, ActionType, TimeStamp) values

              (new.UserID, null, new.FirstName, null,
               new.LastName, null, new.Email, null,
               new.Password, null, new.Salt, null,
               new.SecurityLevel, 'insert', now());
END//

CREATE TRIGGER au_tbUser 
--  after update in tbUser
       AFTER UPDATE ON tbUser
                  FOR EACH ROW
BEGIN 
       INSERT INTO log_tbUser
               (UserID, old_FirstName, new_FirstName, old_LastName,
               new_LastName, old_Email, new_Email, old_Password,
               new_Password, old_Salt, new_Salt, old_SecurityLevel,
               new_SecurityLevel, ActionType, TimeStamp) values

               (new.UserID, old.FirstName, new.FirstName, old.LastName,
               new.LastName, old.Email, new.Email, old.Password,
               new.Password, old.Salt, new.Salt, old.SecurityLevel,
               new.SecurityLevel, 'update', now());
END//

CREATE TRIGGER ad_tbUser  
-- after delete
        AFTER DELETE ON tbUser
                  FOR EACH ROW
BEGIN 
      INSERT INTO log_tbUser
              (UserID, old_FirstName, new_FirstName, old_LastName,
               new_LastName, old_Email, new_Email, old_Password,
               new_Password, old_Salt, new_Salt, old_SecurityLevel,
               new_SecurityLevel, ActionType, TimeStamp) values
 
               (old.UserID, old.FirstName, null, old.LastName,
                null, old.Email, null, old.Password,
                null, old.Salt, null, old.SecurityLevel,
                null, 'delete', now());
END //
DELIMITER ;
     
-- log table for tbChecklist
create table log_tbChecklist(
LogID             int primary key auto_increment,
ChecklistID       int unsigned not null,
old_ChecklistName varchar(60) null,
new_ChecklistName varchar(60) null,         
ActionType  ENUM  ('insert','update','delete') not null,
TimeStamp         timestamp not null           
);

-- stored proc to insert into log_tbChecklist
DELIMITER //
CREATE TRIGGER ai_tbChecklist -- after insert for tbChecklist
       AFTER INSERT ON tbChecklist
                  FOR EACH ROW
BEGIN
       INSERT INTO log_tbChecklist
                (ChecklistID, old_ChecklistName, new_ChecklistName, 
                 ActionType, TimeStamp) values
                
                (new.ChecklistID, null, new.ChecklistName,
                 'insert',now());
END//

CREATE TRIGGER au_tbChecklist -- after update for tbChecklist
        AFTER UPDATE ON tbChecklist
                  FOR EACH ROW
BEGIN
       INSERT INTO log_tbChecklist
                (ChecklistID, old_ChecklistName, new_ChecklistName, 
                 ActionType, TimeStamp) values

                (new.ChecklistID, old.ChecklistName, new.ChecklistName,
                 'update',now());
END//

CREATE TRIGGER ad_tbChecklist -- after delete for tbChecklist
        AFTER DELETE ON tbChecklist
                  FOR EACH ROW
BEGIN
       INSERT INTO log_tbChecklist
                (ChecklistID, old_ChecklistName, new_ChecklistName, 
                 ActionType, TimeStamp) values
                
                (old.ChecklistID, old.ChecklistName, null,
                 'delete',now());
END//
DELIMITER ;

-- log table for tbTask
create table log_tbTask(
LogID             int primary key auto_increment,
TaskID            int unsigned not null,
old_TaskName      varchar(60) null,
new_TaskName      varchar(60) null,
old_ChecklistID   int null,
new_ChecklistID   int null,
old_TaskTime      datetime,
new_TaskTime      datetime,         
ActionType  ENUM  ('insert','update','delete') not null,
TimeStamp         timestamp not null           
);

-- stored proc to insert into log_tbTask
DELIMITER //
CREATE TRIGGER ai_tbTask -- after insert for tbTask
       AFTER INSERT ON tbTask
                  FOR EACH ROW
BEGIN
       INSERT INTO log_tbTask
                 (TaskID, old_TaskName, new_TaskName, old_ChecklistID,
                  new_ChecklistID, old_TaskTime, new_TaskTime,
                  ActionType, TimeStamp) values

                 (new.TaskID, null, new.TaskName, null,
                  new.ChecklistID, null, new.TaskTime,
                  'insert', now());
END//    
  
CREATE TRIGGER au_tbTask -- after update for tbTask
       AFTER UPDATE ON tbTask
                  FOR EACH ROW
BEGIN
       INSERT INTO log_tbTask
                 (TaskID, old_TaskName, new_TaskName, old_ChecklistID,
                  new_ChecklistID, old_TaskTime, new_TaskTime,
                  ActionType, TimeStamp) values
                  
                 (new.TaskID, old.TaskName, new.TaskName, old.ChecklistID,
                  new.ChecklistID, old.TaskTime, new.TaskTime,
                  'update', now());
END//

CREATE TRIGGER ad_tbTask -- after delete for tbTask
       AFTER DELETE ON tbTask
                  FOR EACH ROW
BEGIN
       INSERT INTO log_tbTask
                 (TaskID, old_TaskName, new_TaskName, old_ChecklistID,
                  new_ChecklistID, old_TaskTime, new_TaskTime,
                  ActionType, TimeStamp) values

                 (old.TaskID, old.TaskName, null, old.ChecklistID,
                  null, old.TaskTime, null,
                  'delete', now());
END//
DELIMITER ;


-- log table for tbTaskProperties
create table log_tbTaskProperties(
LogID                 int primary key auto_increment,
TaskPropertyID        int unsigned not null,
old_PropertyName      varchar(60) null,
new_PropertyName      varchar(60) null,
old_PropertyAttribute varchar(120) null,
new_PropertyAttribute varchar(120) null,
old_PropertyValue     decimal(10,2) null,
new_PropertyValue     decimal(10,2) null,        
ActionType  ENUM  ('insert','update','delete') not null,
TimeStamp         timestamp not null           
);

-- stored proc to insert into log_tbTaskProperties
DELIMITER //
CREATE TRIGGER ai_tbTaskProperties -- after insert for tbTaskProperties
       AFTER INSERT ON tbTaskProperties
                  FOR EACH ROW
BEGIN
       INSERT INTO log_tbTaskProperties
                (TaskPropertyID, old_PropertyName, new_PropertyName,
                 old_PropertyAttribute, new_PropertyAttribute,
                 old_PropertyValue, new_PropertyValue, 
                 ActionType, TimeStamp) values
                
                (new.TaskPropertyID, null, new.PropertyName,
                 null, new.PropertyAttribute,
                 null, new.PropertyValue,
                 'insert',now());
END//

CREATE TRIGGER au_tbTaskProperties -- after update for tbTaskProperties
       AFTER UPDATE ON tbTaskProperties
                  FOR EACH ROW
BEGIN
       INSERT INTO log_tbTaskProperties
                 (TaskPropertyID, old_PropertyName, new_PropertyName,
                 old_PropertyAttribute, new_PropertyAttribute,
                 old_PropertyValue, new_PropertyValue, 
                 ActionType, TimeStamp) values
                  
                 (new.TaskPropertyID, old.PropertyName, new.PropertyName, 
                  old.PropertyAttribute, new.PropertyAttribute,
                  old.PropertyValue, new.PropertyValue,
                  'update', now());
END//

CREATE TRIGGER ad_tbTaskProperties -- after delete for tbTaskProperties
       AFTER DELETE ON tbTaskProperties
                  FOR EACH ROW
BEGIN
       INSERT INTO log_tbTaskProperties
                 (TaskPropertyID, old_PropertyName, new_PropertyName,
                 old_PropertyAttribute, new_PropertyAttribute,
                 old_PropertyValue, new_PropertyValue, 
                 ActionType, TimeStamp) values

                 (old.TaskPropertyID, old.PropertyName, null, 
                  old.PropertyAttribute, null,
                  old.PropertyValue, null,
                  'delete', now());
END//
DELIMITER ;