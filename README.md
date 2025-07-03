Hi! My name is Muhammad (or just Mo!), and this is my submission for the 7shifts Junior Developer Assignment. I was a Software Developer Intern at 7shifts from May 2023 - Aug 2024 which allowed me to have some unique insight when completing this assignment.

Having previously interned at 7shifts, my goal was to match the 7shifts tech stack as closely as possible which is why I opted to use PHP for the backend API, and React (Vite) TypeScript for the frontend. I also opted to use the CQRS pattern which I recall is used throughout the webapp backend at 7shifts.

I did not work on this assignment in one sitting, but the total time I spent on it is roughly between 5-6 hours.

Please reach out to me at mabdullahk98@gmail.com if you run into any issues with the project or if you have any other questions. I look forward to discussing it in more detail.

# Tech Stack

### Backend
- **Language:** PHP
- **Pattern:** CQRS (Command Query Responsibility Segregation)
- **Database:** MySQL
- **Testing:** PHPUnit

### Frontend
- **Framework:** React + Vite
- **Language:** TypeScript
- **Component Library:** shadcn
- **Testing:** Jest

### Containerization
- **Docker** for backend, frontend, and database


# Project Structure

### Backend (PHP)
- The backend is organized by feature using folders for commands, handlers, services, and models.
- Each command (like creating staff or a shift) has its own file, and each query (like getting staff or shifts) has a service file.
- `index.php` is a simple router for API requests.
- Database connection is handled in `config/Database.php`.

### Frontend (React)
- The frontend is organized by components in the `src/components` folder.
- Each main feature (like adding staff, listing staff, assigning shifts) has its own component file.
- UI is built using shadcn components.


# Instructions to Run the Project

I have fully containerized the assignment with Docker so that you can test it easily.

### Prerequisites
- Please ensure you have both Docker and Docker Compose installed on your system. (Installing Docker Desktop should install both. [Download Docker Desktop](https://www.docker.com/products/docker-desktop/))

### Steps
1. Download and unzip, or clone the repo from GitHub.
2. In the root directory of the repo, run:
   ```bash
   docker-compose up --build
   ```
3. You can now access the app at: [http://localhost:3000](http://localhost:3000)


# Running the Tests

I have already verified that all tests are passing (in case you are not able to run the tests yourself). To run them yourself follow these steps:

### Backend Tests
While the docker container is running:
1. `docker-compose exec backend bash`
2. `composer install`
3. `vendor/bin/phpunit`

### Frontend Tests
The frontend tests will have to be run locally on your computer. Install Node.js and npm on your computer, then in the root dirctory of the repo run:
1. `cd frontend`
2. `npm install`
3. `npm test` 
