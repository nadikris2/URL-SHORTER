CREATE TABLE 'url'(
    'id' int(11) NOT NULL,
    'shorten_url' varchar(400) NOT NULL,
    'full_url' varchar(2000) NOT NULL, 
    'clicks' int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET = utf8mb4;

ALTER TABLE 'url'
    ADD PRIMARY KEY ('ID')

ALTER TABLE 'url'
    MODIFY 'ID' int(11) NOT NULL AUTO_INCEREMENT,AUTO_INCEREMENT=53;
COMMIT;
