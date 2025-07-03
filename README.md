My name is Muhammad (or just Mo!), and this is my submission for the 7shifts Junior Developer Assignment. I was a Software Developer Intern at 7shifts from May 2023 - Aug 2024 which allowed me to have some unique insight when completing this assignment.

Having previously interned at 7shifts, my goal was to match the 7shifts tech stack as closely as possible which is why I opted to use PHP for the backend API, and React (Vite) TypeScript for the frontend. I also opted to use the CQRS pattern which I recall is used throughout the webapp backend at 7shifts. For the design of the components, I used the Shadcn component library.

I did not work on this assignment in one sitting, but the total time I spent on it is roughly between 5-6 hours.


## Tech Stack

### Backend
- **Language:** PHP
- **Pattern:** CQRS (Command Query Responsibility Segregation)
- **Database:** MySQL
- **Testing:** PHPUnit

### Frontend
- **Framework:** React + Vite
- **Language:** TypeScript
- **Component Library:** Shadcn
- **Testing:** Jest

### Containerization
- **Docker** for backend, frontend, and database


## Instructions to Run the Project

I have fully containerized the assignment with Docker so that you can test it easily.

### Prerequisites
- Please ensure you have both Docker and Docker Compose installed on your system. (Installing Docker Desktop should install both. [Download Docker Desktop](https://www.docker.com/products/docker-desktop/))

### Steps
1. Download and unzip, or clone the repo from GitHub.
2. In the root directory of the repo, run:
   ```bash
   docker-compose up --build
   ```
3. You can now access the frontend for the app at: [http://localhost:3000](http://localhost:3000). I have included some sample data in the app to play around with.

## Running the Tests

Run the following commands in terminal or powershell:
### Backend Tests
While the docker containers are running, in a new terminal run:
1. `docker-compose exec backend bash`
2. `composer install`
3. `vendor/bin/phpunit`

### Frontend Tests
The frontend tests will have to be run locally on your computer. Install Node.js and npm on your computer, then in the root dirctory of the repo run:
1. `cd frontend`
2. `npm install`
3. `npm test` 
