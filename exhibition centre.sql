exhibition centre
DROP TABLE IF EXISTS `Exhibition centre`;
CREATE TABLE IF NOT EXISTS `Exhibition centre` (
  'Name' varchar(100) NOT NULL,
  'Type' varchar NOT NULL,
  'Time start' TIME (0) NOT NULL,
  'Time stop' TIME (0) NOT NULL 
);