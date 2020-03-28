# Fortune crawler
Hosted on GCP Cloud Run.  
https://fortunes-crawler-ua6sx3viua-de.a.run.app/

### Usage

* Login/Register in the top right corner  
![Login/Register](https://user-images.githubusercontent.com/10175554/77820144-029b2880-711b-11ea-8dbd-fc0d9de89542.png)
![Register](https://user-images.githubusercontent.com/10175554/77820182-5148c280-711b-11ea-987b-6f03a5b2f446.png)  
  
  
* Provides username/password login and Google login  
![Login](https://user-images.githubusercontent.com/10175554/77820174-3d04c580-711b-11ea-95bb-b5766fe5c84d.png)  
  
  
* After logged in, redirect automatically to `/home` and display fortunes info filtered by date.
![home](https://user-images.githubusercontent.com/10175554/77820194-5efe4800-711b-11ea-848b-12b0a6096647.png)  
  
 * call `/crawl?date=YYYY-MM-DD` for getting specific fortunes by date
 
 * Scheduled to crawl hourly


### DB schema
```sql
create table users
(
	id INTEGER not null
		primary key autoincrement,
	name VARCHAR(255) not null,
	email VARCHAR(255) not null,
	remember_token VARCHAR(255) default NULL,
	created_at DATETIME default NULL,
	updated_at DATETIME default NULL,
	password VARCHAR(255) default NULL,
	google_id varchar,
	avatar varchar,
	avatar_original varchar
);

create unique index users_email_unique
	on users (email);

```

```sql
create table fortunes
(
	id integer not null
		primary key autoincrement,
	created_at datetime,
	updated_at datetime,
	constellation varchar not null,
	date date not null,
	overall_fortune_score varchar not null,
	overall_fortune_description varchar not null,
	love_fortune_score varchar not null,
	love_fortune_description varchar not null,
	career_fortune_score varchar not null,
	career_fortune_description varchar not null,
	wealth_fortune_score varchar not null,
	wealth_fortune_description varchar not null
);

create index fortunes_constellation_date_index
	on fortunes (constellation, date);


```
