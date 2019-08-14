"""create parser tables

Revision ID: 182a18533fdf
Revises: 9d499741b60f
Create Date: 2019-07-25 12:48:00.935927

"""
from alembic import op
import sqlalchemy as sa


# revision identifiers, used by Alembic.
revision = '182a18533fdf'
down_revision = None
branch_labels = None
depends_on = None


def upgrade():
    op.create_table(
        'hotels',
        sa.Column('id', sa.Integer, primary_key=True),
        sa.Column('name', sa.String(255), nullable=False),
        sa.Column('description', sa.Text(), nullable=False),
        sa.Column('address', sa.String(255), nullable=False),
        sa.Column('city', sa.String(255), nullable=False),
        sa.Column('postcode', sa.String(255), nullable=False),
        sa.Column('country', sa.String(255), nullable=False),
        sa.Column('rating', sa.DECIMAL(10, 1), nullable=False),
        sa.Column('image', sa.String(255), nullable=False),
        sa.Column('url_hotel', sa.String(255), nullable=False),
        sa.Column('created_at', sa.TIMESTAMP, nullable=False),
        sa.Column('updated_at', sa.TIMESTAMP, nullable=False),
    )

    op.create_table(
        'rooms',
        sa.Column('id', sa.Integer, primary_key=True),
        sa.Column('name', sa.String(255), nullable=False),
        sa.Column('image', sa.String(255), nullable=False),
        sa.Column('price', sa.String(255), nullable=False),
        sa.Column('occupancy', sa.String(255), nullable=False),
        sa.Column('hotel_id', sa.Integer(), nullable=False),
        sa.ForeignKeyConstraint(['hotel_id'], ['hotels.id'], )
    )

    op.create_table(
        'room_variants',
        sa.Column('id', sa.Integer, primary_key=True),
        sa.Column('price', sa.String(255), nullable=False),
        sa.Column('occupancy', sa.String(255), nullable=False),
        sa.Column('room_id', sa.Integer(), nullable=False),
        sa.ForeignKeyConstraint(['room_id'], ['rooms.id'], )
    )


def downgrade():
    op.drop_table('hotels')
    op.drop_table('rooms')
    op.drop_table('room_variants')
