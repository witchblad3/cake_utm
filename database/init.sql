DROP TABLE IF EXISTS utm_data;

CREATE TABLE utm_data (
                          id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                          source VARCHAR(255) NOT NULL,
                          medium VARCHAR(255) NOT NULL,
                          campaign VARCHAR(255) NOT NULL,
                          content VARCHAR(255) DEFAULT NULL,
                          term VARCHAR(255) DEFAULT NULL,
                          created DATETIME DEFAULT NULL,
                          modified DATETIME DEFAULT NULL,
                          PRIMARY KEY (id),
                          KEY idx_source (source)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO utm_data (source, medium, campaign, content, term) VALUES
                                                                   ('google', 'cpc', 'summer', 'banner', 'video'),
                                                                   ('google', 'cpc', 'winter', 'delta', NULL),
                                                                   ('facebook', 'social', 'brand_awareness', 'story', 'retargeting'),
                                                                   ('facebook', 'social', 'leadgen', NULL, 'form'),
                                                                   ('yandex', 'cpc', 'autumn_sale', 'text', 'shoes'),
                                                                   ('newsletter', 'email', 'weekly_digest', NULL, NULL);