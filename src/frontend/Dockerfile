# Using a stable version of node
FROM node:16-alpine

# Set working directory
WORKDIR /app

# Copy package.json and package-lock.json
COPY package*.json ./

# Install dependencies
RUN npm install

# Copy project files into the docker image
COPY . .

RUN npm run build

# Expose the port the dev server runs on
EXPOSE 5173

# Command to run when starting the container
CMD ["npm", "run", "preview", "--", "--port", "5173", "--host"]
