CREATE DATABASE IF NOT EXISTS risktooldb;
USE risktooldb;
CREATE TABLE risks (
risk_id INT AUTO_INCREMENT,
date VARCHAR(20),
product VARCHAR(20),
process_project VARCHAR(20),
failure_mode VARCHAR(256),
failure_effect VARCHAR(256),
SEV_inherent INT,
SEV INT,
failure_mode_cause VARCHAR(256),
stakeholders_cause VARCHAR(256),
OCC_inherent INT,
OCC INT,
current_control VARCHAR(256),
preventive_control INT,
detective_control INT,
corrective_control INT,
DET INT,
bottleneck VARCHAR(20),
RPN_inherent INT,
RPN INT,
risk_level VARCHAR(20),
stakeholders_affected VARCHAR(20),
acceptable VARCHAR(20),
actions VARCHAR(256),
PRIMARY KEY (risk_id)
);
CREATE TABLE users (
user_id INT AUTO_INCREMENT,
username VARCHAR(30),
password VARCHAR(256),
role VARCHAR(30),
team VARCHAR(30),
process_project VARCHAR(30),
PRIMARY KEY (user_id)
);
CREATE TABLE modifications (
modif_id INT AUTO_INCREMENT,
risk_id INT,
modification VARCHAR(256),
PRIMARY KEY (modif_id)
);
