resource "aws_eip" "virginia" {
  vpc = true
}

resource "aws_nat_gateway" "virginia" {
  subnet_id = "subnet-0f8d498cd98a23993"
  allocation_id = aws_eip.virginia.allocation_id
}

resource "aws_route" "virginia" {
  route_table_id            = "rtb-0d9800d9819e5fed5"
  destination_cidr_block    = "0.0.0.0/0"
  nat_gateway_id = aws_nat_gateway.virginia.id
}

resource "aws_eip" "california" {
  vpc = true
  provider = aws.us_west_1
}

resource "aws_nat_gateway" "california" {
  subnet_id = "subnet-00da7d682634da8e8"
  allocation_id = aws_eip.california.allocation_id
  provider = aws.us_west_1
}

resource "aws_route" "california" {
  route_table_id            = "rtb-08f6c068ec2d2868b"
  destination_cidr_block    = "0.0.0.0/0"
  nat_gateway_id = aws_nat_gateway.california.id
  provider = aws.us_west_1
}
