FROM php:7.2-apache

ARG IMAGE_CREATE_DATE
ARG IMAGE_VERSION
ARG IMAGE_SOURCE_REVISION

# Arguments
ARG SELECTOR
ARG SERVICE

# Environment Variables
ENV SELECTOR $SELECTOR
ENV SERVICE $SERVICE

# Metadata as defined in OCI image spec annotations - https://github.com/opencontainers/image-spec/blob/master/annotations.md
LABEL org.opencontainers.image.title="Eris" \
      org.opencontainers.image.description="Cat/City of the Day (COTD) example PHP User Interface for Kubernetes" \
      org.opencontainers.image.created=$IMAGE_CREATE_DATE \
      org.opencontainers.image.version=$IMAGE_VERSION \
      org.opencontainers.image.authors="Anthony Angelo" \
      org.opencontainers.image.url="https://github.com/pangealab/eris/" \
      org.opencontainers.image.documentation="https://github.com/pangealab/eris/README.md" \
      org.opencontainers.image.vendor="Anthony Angelo" \
      org.opencontainers.image.licenses="MIT" \
      org.opencontainers.image.source="https://github.com/pangealab/eris.git" \
      org.opencontainers.image.revision=$IMAGE_SOURCE_REVISION 

# Declare Ports
EXPOSE 80

# Copy App
COPY . /var/www/html/