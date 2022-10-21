

CREATE TABLE companies (
  companies_id INT NOT NULL AUTO_INCREMENT,
  companies_name VARCHAR(255) NOT NULL,
  companies_street VARCHAR(255) NOT NULL,
  companies_extended VARCHAR(255),
  companies_city VARCHAR(255) NOT NULL,
  states_id INT NOT NULL,
  companies_zip VARCHAR(10) NOT NULL,
  PRIMARY KEY (companies_id),
  FOREIGN KEY fk_states_id (states_id) REFERENCES states (states_id)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE states (
  states_id INT NOT NULL AUTO_INCREMENT,
  states_code CHAR(2) NOT NULL,
  states_name VARCHAR(255) NOT NULL,
  PRIMARY KEY (states_id)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci; 

INSERT INTO states VALUES (NULL, 'AL', 'Alabama');
INSERT INTO states VALUES (NULL, 'AK', 'Alaska');
INSERT INTO states VALUES (NULL, 'AZ', 'Arizona');
INSERT INTO states VALUES (NULL, 'AR', 'Arkansas');
INSERT INTO states VALUES (NULL, 'CA', 'California');
INSERT INTO states VALUES (NULL, 'CO', 'Colorado');
INSERT INTO states VALUES (NULL, 'CT', 'Connecticut');
INSERT INTO states VALUES (NULL, 'DE', 'Delaware');
INSERT INTO states VALUES (NULL, 'FL', 'Florida');
INSERT INTO states VALUES (NULL, 'GA', 'Georgia');
INSERT INTO states VALUES (NULL, 'HI', 'Hawaii');
INSERT INTO states VALUES (NULL, 'ID', 'Idaho');
INSERT INTO states VALUES (NULL, 'IL', 'Illinois');
INSERT INTO states VALUES (NULL, 'IN', 'Indiana');
INSERT INTO states VALUES (NULL, 'IA', 'Iowa');
INSERT INTO states VALUES (NULL, 'KS', 'Kansas');
INSERT INTO states VALUES (NULL, 'KY', 'Kentucky');
INSERT INTO states VALUES (NULL, 'LA', 'Louisiana');
INSERT INTO states VALUES (NULL, 'ME', 'Maine');
INSERT INTO states VALUES (NULL, 'MD', 'Maryland');
INSERT INTO states VALUES (NULL, 'MA', 'Massachusetts');
INSERT INTO states VALUES (NULL, 'MI', 'Michigan');
INSERT INTO states VALUES (NULL, 'MN', 'Minnesota');
INSERT INTO states VALUES (NULL, 'MS', 'Mississippi');
INSERT INTO states VALUES (NULL, 'MO', 'Missouri');
INSERT INTO states VALUES (NULL, 'MT', 'Montana');
INSERT INTO states VALUES (NULL, 'NE', 'Nebraska');
INSERT INTO states VALUES (NULL, 'NV', 'Nevada');
INSERT INTO states VALUES (NULL, 'NH', 'New Hampshire');
INSERT INTO states VALUES (NULL, 'NJ', 'New Jersey');
INSERT INTO states VALUES (NULL, 'NM', 'New Mexico');
INSERT INTO states VALUES (NULL, 'NY', 'New York');
INSERT INTO states VALUES (NULL, 'NC', 'North Carolina');
INSERT INTO states VALUES (NULL, 'ND', 'North Dakota');
INSERT INTO states VALUES (NULL, 'OH', 'Ohio');
INSERT INTO states VALUES (NULL, 'OK', 'Oklahoma');
INSERT INTO states VALUES (NULL, 'OR', 'Oregon');
INSERT INTO states VALUES (NULL, 'PA', 'Pennsylvania');
INSERT INTO states VALUES (NULL, 'RI', 'Rhode Island');
INSERT INTO states VALUES (NULL, 'SC', 'South Carolina');
INSERT INTO states VALUES (NULL, 'SD', 'South Dakota');
INSERT INTO states VALUES (NULL, 'TN', 'Tennessee');
INSERT INTO states VALUES (NULL, 'TX', 'Texas');
INSERT INTO states VALUES (NULL, 'UT', 'Utah');
INSERT INTO states VALUES (NULL, 'VT', 'Vermont');
INSERT INTO states VALUES (NULL, 'VA', 'Virginia');
INSERT INTO states VALUES (NULL, 'WA', 'Washington');
INSERT INTO states VALUES (NULL, 'WV', 'West Virginia');
INSERT INTO states VALUES (NULL, 'WI', 'Wisconsin');
INSERT INTO states VALUES (NULL, 'WY', 'Wyoming');

CREATE TABLE employees (
  employees_id INT NOT NULL AUTO_INCREMENT,
  employees_name VARCHAR(255) NOT NULL,
  companies_id INT NOT NULL,
  PRIMARY KEY (employees_id),
  FOREIGN KEY fk_company (companies_id) REFERENCES companies (companies_id) ON DELETE CASCADE
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci; 
