# builder image
FROM golang:1.18 as builder
RUN mkdir /build
ADD apps/scp.bz/reader/main.go /build/
ADD apps/scp.bz/reader/go.mod /build/
WORKDIR /build
RUN go get scp-bz-reader
RUN CGO_ENABLED=0 GOOS=linux go build -a -o scp-bz-reader .


# generate clean, final image for end users
FROM scratch
COPY --from=builder /build/scp-bz-reader .

# executable
EXPOSE 8080
ENTRYPOINT [ "./scp-bz-reader" ]
