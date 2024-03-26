CREATE TABLE Students (
    StudentID INT PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Address VARCHAR(100)
);

CREATE TABLE Professors (
    ProfessorID INT PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Address VARCHAR(100)
);

CREATE TABLE Subjects (
    SubjectID INT PRIMARY KEY,
    SubjectName VARCHAR(50),
    HoursPerWeek INT
);

CREATE TABLE Classes (
    ClassID INT PRIMARY KEY,
    ClassName VARCHAR(50),
    ClassroomNumber INT,
    ProfessorID INT,
    SubjectID INT,
    HoursPerWeek INT,
    FOREIGN KEY (ProfessorID) REFERENCES Professors(ProfessorID),
    FOREIGN KEY (SubjectID) REFERENCES Subjects(SubjectID)
);

CREATE TABLE Grades (
    GradeID INT PRIMARY KEY,
    ClassID INT,
    StudentID INT,
    Grade INT,
    ExamDate DATE,
    FOREIGN KEY (ClassID) REFERENCES Classes(ClassID),
    FOREIGN KEY (StudentID) REFERENCES Students(StudentID)
);

CREATE TABLE Timetables (
    TimetableID INT PRIMARY KEY,
    ClassID INT,
    Weekday VARCHAR(10),
    StartTime TIME,
    EndTime TIME,
    FOREIGN KEY (ClassID) REFERENCES Classes(ClassID)
);

ALTER TABLE Classes ADD CONSTRAINT UniqueClassroom UNIQUE (ClassroomNumber);

ALTER TABLE Classes ADD CONSTRAINT UniqueProfessorPerClass UNIQUE (ProfessorID);

ALTER TABLE Timetables ADD CONSTRAINT NoSimultaneousClasses
CHECK (NOT EXISTS (
    SELECT 1
    FROM Timetables t1
    JOIN Timetables t2 ON t1.ProfessorID = t2.ProfessorID
    WHERE t1.TimetableID <> t2.TimetableID
      AND t1.Weekday = t2.Weekday
      AND (
          (t1.StartTime BETWEEN t2.StartTime AND t2.EndTime)
          OR (t1.EndTime BETWEEN t2.StartTime AND t2.EndTime)
      )
));

ALTER TABLE Classes ADD CONSTRAINT FixedFiniteHours CHECK (HoursPerWeek > 0);
