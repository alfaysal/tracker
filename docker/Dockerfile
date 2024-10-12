# Dockerfile for Vue.js
FROM node:18

# Set working directory
WORKDIR /app

# Copy package.json and install dependencies
COPY package*.json ./
RUN npm install

# Copy app files
COPY . .

# Build the app for production
RUN npm run build

# Expose port
EXPOSE 8080

# Start the app
CMD ["npm", "run", "serve"]
