# Use the official Node.js 20 image
FROM node:20-alpine

# Create and change to the app directory
WORKDIR /usr/src/app

# Copy the rest of the app files
COPY . .

# Make the start script executable
RUN chmod +x start.sh

# Expose the port the app runs on
EXPOSE 3000

# Default command
CMD ["sh", "start.sh"]
