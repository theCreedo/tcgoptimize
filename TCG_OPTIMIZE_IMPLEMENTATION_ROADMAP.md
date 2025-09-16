# TCG Optimize - Complete Implementation Roadmap

## Project Overview
Transform the current discount calculator into a comprehensive TCG marketplace toolkit serving serious sellers and traders with automation, analytics, and optimization tools.

---

## **PHASE 1: Foundation & Security (Weeks 1-4)**
*Establish production-ready codebase with enhanced discount tool*

### Week 1: Security & Code Quality Foundation

#### 1.1 Enhanced User Management System
**Files to Create/Modify:**
- `database/migrations/xxxx_enhance_users_table.php`
- `app/Models/User.php` (enhance existing)
- `app/Models/UserProfile.php` (new)

**Implementation Steps:**
```sql
-- Migration: enhance users table
ALTER TABLE users ADD COLUMN:
- tcgplayer_username VARCHAR(255) NULL
- discord_username VARCHAR(255) NULL
- preferred_currency ENUM('USD', 'CAD', 'EUR') DEFAULT 'USD'
- timezone VARCHAR(50) DEFAULT 'UTC'
- email_notifications BOOLEAN DEFAULT true

-- Create user_profiles table
- id, user_id, business_name, tax_id, address fields
- seller_level ENUM('casual', 'semi_pro', 'professional')
- platforms JSON (tcgplayer, ebay, facebook, discord)
```

**Tasks:**
1. Create enhanced user migration
2. Build UserProfile model with relationships
3. Add user settings controller
4. Create user dashboard basic layout

#### 1.2 Security Hardening
**Files to Modify:**
- `app/Http/Controllers/DiscountController.php`
- `app/Http/Requests/DiscountFormRequest.php` (new)
- `config/app.php`

**Implementation Steps:**
```php
// Create form request validation
class DiscountFormRequest extends FormRequest {
    public function rules(): array {
        return [
            'input' => ['required', 'string', 'max:10000', 'regex:/^[\w\s\$\.,\-\n\r]+$/'],
            'settings' => ['required', 'integer', 'between:50,100']
        ];
    }
}

// Enhanced controller with type hints and validation
class DiscountController extends Controller {
    public function submitForm(DiscountFormRequest $request): RedirectResponse
    // Add XSS protection, rate limiting, error handling
}
```

**Tasks:**
1. Implement form request validation
2. Add XSS protection and input sanitization
3. Create custom validation rules for price formats
4. Add comprehensive error handling

#### 1.3 Enhanced Discount Tool
**Files to Create/Modify:**
- `app/Services/DiscountCalculatorService.php` (new)
- `resources/views/discount.blade.php`
- `app/Http/Controllers/DiscountController.php`

**Implementation Steps:**
```php
// Service class for business logic
class DiscountCalculatorService {
    public function calculateDiscounts(string $input, float $percentage): array
    public function validatePriceFormat(string $input): bool
    public function extractPrices(string $input): array
    public function applyDiscountWithRounding(float $price, float $percentage): float
}
```

**Tasks:**
1. Extract business logic to service class
2. Add support for multiple currencies
3. Implement custom discount percentages
4. Add export functionality (CSV, JSON)
5. Improve UI with loading states and better feedback

### Week 2: Modern Frontend & Performance

#### 2.1 Frontend Modernization
**Files to Modify:**
- `resources/views/discount.blade.php`
- `resources/js/app.js`
- `resources/js/components/DiscountCalculator.js` (new)

**Implementation Steps:**
```javascript
// Modern clipboard API
class DiscountCalculator {
    async copyToClipboard(text) {
        try {
            await navigator.clipboard.writeText(text);
            this.showNotification('Text copied!', 'success');
        } catch (err) {
            this.fallbackCopy(text);
        }
    }
}
```

**Tasks:**
1. Replace deprecated document.execCommand with modern Clipboard API
2. Add proper error handling and user feedback
3. Implement accessibility improvements (ARIA labels, keyboard navigation)
4. Add input validation on frontend

#### 2.2 Database Architecture for Future Features
**Files to Create:**
- `database/migrations/xxxx_create_tcg_games_table.php`
- `database/migrations/xxxx_create_cards_table.php`
- `database/migrations/xxxx_create_price_alerts_table.php`
- `app/Models/TcgGame.php`
- `app/Models/Card.php`
- `app/Models/PriceAlert.php`

**Database Schema:**
```sql
-- TCG Games table
CREATE TABLE tcg_games (
    id BIGINT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(10) UNIQUE NOT NULL,
    api_id VARCHAR(255),
    is_active BOOLEAN DEFAULT true
);

-- Cards table
CREATE TABLE cards (
    id BIGINT PRIMARY KEY,
    tcg_game_id BIGINT,
    name VARCHAR(255) NOT NULL,
    set_name VARCHAR(255),
    tcgplayer_id BIGINT,
    image_url TEXT,
    rarity VARCHAR(50),
    card_type VARCHAR(100)
);

-- Price tracking
CREATE TABLE price_histories (
    id BIGINT PRIMARY KEY,
    card_id BIGINT,
    price DECIMAL(10,2),
    condition ENUM('NM', 'LP', 'MP', 'HP', 'D'),
    marketplace VARCHAR(50),
    recorded_at TIMESTAMP
);
```

### Week 3: Testing & Quality Assurance

#### 3.1 Comprehensive Testing Suite
**Files to Create:**
- `tests/Feature/DiscountControllerTest.php`
- `tests/Unit/DiscountCalculatorServiceTest.php`
- `tests/Browser/DiscountCalculatorTest.php` (Dusk)

**Testing Strategy:**
```php
// Feature tests for controller
class DiscountControllerTest extends TestCase {
    public function test_validates_input_correctly()
    public function test_calculates_discounts_accurately()
    public function test_prevents_xss_attacks()
    public function test_handles_invalid_percentage_values()
}

// Unit tests for service
class DiscountCalculatorServiceTest extends TestCase {
    public function test_extracts_prices_from_text()
    public function test_applies_discount_with_rounding()
    public function test_handles_edge_cases()
}
```

#### 3.2 Performance Optimization
**Files to Create/Modify:**
- `config/cache.php`
- `app/Http/Middleware/CacheResponse.php` (new)

**Tasks:**
1. Implement Redis caching for session data
2. Add response caching for static content
3. Optimize database queries
4. Set up performance monitoring

### Week 4: Deployment & Monitoring

#### 4.1 Production Readiness
**Files to Create:**
- `.github/workflows/ci.yml`
- `docker-compose.yml`
- `config/monitoring.php`

**Tasks:**
1. Set up CI/CD pipeline
2. Configure error tracking (Sentry)
3. Implement health checks
4. Set up SSL and security headers

---

## **PHASE 2: Core Market Intelligence (Weeks 5-8)**
*Build price tracking and market analysis foundation*

### Week 5: TCGPlayer API Integration

#### 5.1 API Foundation
**Files to Create:**
- `app/Services/TcgPlayerApiService.php`
- `app/Http/Controllers/Api/TcgPlayerController.php`
- `config/tcgplayer.php`

**Implementation Steps:**
```php
class TcgPlayerApiService {
    public function authenticate(): string
    public function searchCards(string $query, int $gameId): array
    public function getCardPrices(int $cardId): array
    public function getMarketData(int $cardId): array
}
```

**API Endpoints to Implement:**
- `GET /api/tcgplayer/search` - Card search
- `GET /api/tcgplayer/prices/{cardId}` - Current prices
- `GET /api/tcgplayer/market-data/{cardId}` - Market trends

#### 5.2 Price Tracking System
**Files to Create:**
- `app/Models/PriceHistory.php`
- `app/Jobs/UpdatePricesJob.php`
- `app/Services/PriceTrackingService.php`

**Background Jobs:**
```php
class UpdatePricesJob implements ShouldQueue {
    public function handle(PriceTrackingService $service): void
    // Fetch and store price data every 15 minutes
}
```

### Week 6: Price Alert System

#### 6.1 Alert Management
**Files to Create:**
- `app/Models/PriceAlert.php`
- `app/Http/Controllers/PriceAlertController.php`
- `app/Jobs/CheckPriceAlertsJob.php`
- `app/Notifications/PriceAlertNotification.php`

**Alert Types:**
```php
class PriceAlert extends Model {
    // Alert types: price_drop, price_spike, percentage_change
    // Notification methods: email, discord_webhook, browser
    public function checkCondition(float $currentPrice): bool
}
```

#### 6.2 User Dashboard
**Files to Create:**
- `resources/views/dashboard/index.blade.php`
- `resources/views/dashboard/alerts.blade.php`
- `app/Http/Controllers/DashboardController.php`

**Dashboard Features:**
- Active price alerts list
- Recent price changes
- Portfolio value tracking
- Quick actions (add alert, search cards)

### Week 7: Market Analysis Tools

#### 7.1 Price History Charts
**Files to Create:**
- `resources/js/components/PriceChart.js`
- `app/Http/Controllers/Api/ChartDataController.php`

**Chart Implementation:**
```javascript
// Using Chart.js for price visualization
class PriceChart {
    renderPriceHistory(cardId, timeframe)
    showTrendlines()
    highlightSignificantEvents()
}
```

#### 7.2 Market Trends Analysis
**Files to Create:**
- `app/Services/MarketAnalysisService.php`
- `app/Models/MarketTrend.php`

**Analysis Features:**
```php
class MarketAnalysisService {
    public function calculateTrendDirection(int $cardId, int $days): string
    public function identifyPriceSpikes(array $priceHistory): array
    public function predictNextMovement(int $cardId): array
}
```

### Week 8: Collection Management

#### 8.1 Collection Tracking
**Files to Create:**
- `app/Models/Collection.php`
- `app/Models/CollectionItem.php`
- `app/Http/Controllers/CollectionController.php`

**Collection Features:**
```php
class Collection extends Model {
    public function totalValue(): float
    public function valueByCondition(): array
    public function topCards(int $limit = 10): array
}
```

#### 8.2 Portfolio Analytics
**Files to Create:**
- `resources/views/collection/portfolio.blade.php`
- `app/Services/PortfolioAnalyticsService.php`

---

## **PHASE 3: Inventory & Sales Tools (Weeks 9-12)**

### Week 9: Inventory Management System

#### 9.1 Inventory Database Design
**Files to Create:**
- `database/migrations/xxxx_create_inventory_table.php`
- `app/Models/InventoryItem.php`
- `app/Services/InventoryService.php`

**Inventory Schema:**
```sql
CREATE TABLE inventory_items (
    id BIGINT PRIMARY KEY,
    user_id BIGINT,
    card_id BIGINT,
    condition ENUM('NM', 'LP', 'MP', 'HP', 'D'),
    quantity INTEGER,
    purchase_price DECIMAL(10,2),
    current_market_price DECIMAL(10,2),
    listing_price DECIMAL(10,2),
    platform VARCHAR(50),
    status ENUM('available', 'listed', 'sold', 'reserved')
);
```

#### 9.2 Bulk Import/Export
**Files to Create:**
- `app/Http/Controllers/InventoryImportController.php`
- `app/Services/CsvImportService.php`
- `app/Jobs/ProcessInventoryImportJob.php`

**Import Features:**
```php
class CsvImportService {
    public function validateFormat(string $filePath): array
    public function importFromTcgPlayer(string $filePath): int
    public function importFromCustomFormat(string $filePath): int
}
```

### Week 10: Listing Management

#### 10.1 Multi-Platform Listing
**Files to Create:**
- `app/Services/ListingService.php`
- `app/Models/Listing.php`
- `app/Http/Controllers/ListingController.php`

**Listing Features:**
```php
class ListingService {
    public function createListing(InventoryItem $item, array $platforms): Listing
    public function updatePrices(Listing $listing, float $newPrice): bool
    public function syncWithTcgPlayer(Listing $listing): bool
}
```

#### 10.2 Automated Repricing
**Files to Create:**
- `app/Jobs/AutoRepricingJob.php`
- `app/Services/RepricingService.php`

**Repricing Logic:**
```php
class RepricingService {
    public function calculateOptimalPrice(InventoryItem $item): float
    public function applyMarketBasedPricing(InventoryItem $item): float
    public function respectMinimumMargins(float $price, float $cost): float
}
```

### Week 11: Sales Analytics

#### 11.1 Sales Tracking
**Files to Create:**
- `app/Models/Sale.php`
- `app/Http/Controllers/SalesController.php`
- `app/Services/SalesAnalyticsService.php`

**Sales Analytics:**
```php
class SalesAnalyticsService {
    public function monthlyRevenue(int $userId): array
    public function profitMarginAnalysis(int $userId): array
    public function topSellingCards(int $userId, int $limit): array
    public function platformPerformance(int $userId): array
}
```

#### 11.2 Financial Reports
**Files to Create:**
- `resources/views/reports/financial.blade.php`
- `app/Http/Controllers/ReportsController.php`

### Week 12: Customer Management

#### 12.1 Customer Database
**Files to Create:**
- `app/Models/Customer.php`
- `app/Models/CustomerTransaction.php`
- `app/Http/Controllers/CustomerController.php`

**CRM Features:**
```php
class Customer extends Model {
    public function lifetimeValue(): float
    public function purchaseHistory(): Collection
    public function preferredCards(): array
}
```

---

## **PHASE 4: Advanced Market Tools (Weeks 13-16)**

### Week 13: Arbitrage Detection

#### 13.1 Cross-Platform Price Comparison
**Files to Create:**
- `app/Services/ArbitrageService.php`
- `app/Models/ArbitrageOpportunity.php`
- `app/Jobs/ScanArbitrageOpportunitiesJob.php`

**Arbitrage Logic:**
```php
class ArbitrageService {
    public function scanOpportunities(): array
    public function calculateProfitPotential(array $prices): float
    public function filterByUserCriteria(array $opportunities, User $user): array
}
```

#### 13.2 Opportunity Alerts
**Files to Create:**
- `app/Notifications/ArbitrageAlertNotification.php`
- `resources/views/arbitrage/opportunities.blade.php`

### Week 14: Meta Analysis Integration

#### 14.1 Tournament Data Integration
**Files to Create:**
- `app/Services/TournamentDataService.php`
- `app/Models/Tournament.php`
- `app/Models/Deck.php`

**Meta Tracking:**
```php
class TournamentDataService {
    public function fetchRecentResults(): array
    public function analyzeDeckTrends(): array
    public function predictMetaChanges(): array
}
```

#### 14.2 Meta Impact on Prices
**Files to Create:**
- `app/Services/MetaAnalysisService.php`
- `app/Jobs/AnalyzeMetaImpactJob.php`

### Week 15: Advanced Analytics

#### 15.1 Predictive Modeling
**Files to Create:**
- `app/Services/PredictiveAnalyticsService.php`
- `app/Models/PricePrediction.php`

**ML Integration:**
```php
class PredictiveAnalyticsService {
    public function predictPriceMovement(int $cardId, int $days): array
    public function calculateConfidenceInterval(array $prediction): array
    public function identifyInfluencingFactors(int $cardId): array
}
```

#### 15.2 Market Intelligence Dashboard
**Files to Create:**
- `resources/views/intelligence/dashboard.blade.php`
- `app/Http/Controllers/IntelligenceController.php`

### Week 16: API Development

#### 16.1 Public API
**Files to Create:**
- `app/Http/Controllers/Api/V1/CardsController.php`
- `app/Http/Controllers/Api/V1/PricesController.php`
- `app/Http/Middleware/ApiAuthentication.php`

**API Endpoints:**
```
GET /api/v1/cards/search
GET /api/v1/cards/{id}/prices
GET /api/v1/cards/{id}/trends
POST /api/v1/alerts
GET /api/v1/portfolio/value
```

#### 16.2 Webhook System
**Files to Create:**
- `app/Services/WebhookService.php`
- `app/Models/Webhook.php`

---

## **PHASE 5: Automation & Integration (Weeks 17-20)**

### Week 17: Bulk Operations

#### 17.1 Bulk Listing Tools
**Files to Create:**
- `app/Services/BulkListingService.php`
- `app/Jobs/BulkCreateListingsJob.php`
- `resources/views/bulk/listings.blade.php`

### Week 18: External Integrations

#### 18.1 eBay Integration
**Files to Create:**
- `app/Services/EbayApiService.php`
- `app/Models/EbayListing.php`

#### 18.2 Facebook Marketplace Integration
**Files to Create:**
- `app/Services/FacebookMarketplaceService.php`

### Week 19: Automation Workflows

#### 19.1 Rule-Based Automation
**Files to Create:**
- `app/Models/AutomationRule.php`
- `app/Services/AutomationEngine.php`

### Week 20: Advanced Features

#### 20.1 AI-Powered Recommendations
**Files to Create:**
- `app/Services/RecommendationEngine.php`

#### 20.2 Advanced Reporting
**Files to Create:**
- `app/Services/AdvancedReportingService.php`

---

## **Success Metrics & KPIs**

### Phase 1 Success Criteria:
- ✅ Zero security vulnerabilities in penetration testing
- ✅ 100% test coverage for discount calculator
- ✅ Page load times under 2 seconds
- ✅ Mobile responsiveness score 95+

### Phase 2 Success Criteria:
- ✅ Price alerts deliver within 5 minutes of market changes
- ✅ Support tracking 1000+ cards simultaneously
- ✅ Historical data accuracy 99.5%+
- ✅ User dashboard loads in under 1 second

### Phase 3 Success Criteria:
- ✅ Inventory sync with TCGPlayer under 30 seconds
- ✅ Automated repricing executes within 15 minutes
- ✅ Sales tracking accuracy 100%
- ✅ Export functionality supports 10,000+ items

### Phase 4 Success Criteria:
- ✅ Arbitrage detection finds 50+ opportunities daily
- ✅ Meta analysis predicts price movements 70%+ accuracy
- ✅ API response times under 200ms
- ✅ Predictive models show 65%+ success rate

### Phase 5 Success Criteria:
- ✅ Bulk operations handle 1000+ items in under 5 minutes
- ✅ Cross-platform synchronization 99%+ reliable
- ✅ Automation rules execute with 100% accuracy
- ✅ User satisfaction score 4.5+ stars

---

## **Resource Requirements**

### Development Team:
- **Weeks 1-8**: 1 Full-stack developer (you)
- **Weeks 9-16**: Consider adding frontend specialist
- **Weeks 17-20**: May need ML/AI consultant for advanced features

### Infrastructure:
- **Phase 1**: Basic hosting (shared/VPS)
- **Phase 2**: Dedicated server + Redis cache
- **Phase 3**: Load balancer + database clustering
- **Phase 4**: CDN + advanced monitoring
- **Phase 5**: Auto-scaling cloud infrastructure

### External Services:
- TCGPlayer API access
- eBay Developer Account
- Email service (SendGrid/Mailgun)
- Error tracking (Sentry)
- Analytics (Google Analytics Pro)

---

## **Risk Mitigation**

### Technical Risks:
- **API Rate Limits**: Implement intelligent caching and request queuing
- **Data Accuracy**: Multiple data source validation and user feedback loops
- **Scalability**: Design with horizontal scaling from Phase 1

### Business Risks:
- **API Changes**: Maintain adapter pattern for easy service swapping
- **Market Changes**: Build flexible pricing models
- **Competition**: Focus on unique value propositions and user experience

### Implementation Risks:
- **Scope Creep**: Stick to phase deliverables, document future enhancements
- **Technical Debt**: Maintain 80%+ test coverage throughout
- **User Adoption**: Gather feedback after each phase, iterate based on usage

---

This roadmap provides a clear path from your current discount calculator to a comprehensive TCG marketplace toolkit. Each phase builds upon the previous one while delivering immediate value to users. The modular approach allows you to adjust timelines and priorities based on user feedback and market demands.