create DATABASE lab1;

use lab1;



-- users table
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dept_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`email`)
);


-- departments
CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


-- creating courses table
CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `instructor_name` varchar(255) NOT NULL,
  `credit_hours` smallint(6) NOT NULL,
  `dept_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`dept_id`) REFERENCES departments(`id`)
);

-- enrollments
CREATE TABLE `enrollments` (
  course_id INT NOT NULL,
    sid INT NOT NULL,
    FOREIGN KEY (course_id) REFERENCES courses(id),
    FOREIGN KEY (sid) REFERENCES users(id),
    PRIMARY KEY (`course_id`,`sid`)
);